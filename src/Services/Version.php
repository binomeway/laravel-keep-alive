<?php

namespace BinomeWay\KeepAlive\Services;

use BinomeWay\KeepAlive\Contracts\VersionRepository;
use Illuminate\Support\Traits\Macroable;

final class Version
{
    use Macroable;

    protected ?string $current;

    public function __construct(
        protected readonly VersionRepository $repository,
        protected readonly string $latestVersion = '0.0.0')
    {
        $this->current = $this->repository->get($this->latestVersion);
    }

    public function latest(): string
    {
        return $this->latestVersion;
    }

    public function compare(string|Version $edition, ?string $operator = '=='): bool|int
    {
        return version_compare(
            $this->current,
            $edition instanceof Version ? $edition->value() : $edition,
            $operator
        );
    }

    public function isLatest(): bool
    {
        if ($this->exists() && version_compare($this->value(), $this->latest(), '>=')) {
            return false;
        }

        return true;
    }

    public function exists(): bool
    {
        return $this->repository->exists();
    }

    public function update(string $version): Version
    {
        $this->current = $version;

        $this->repository->set($version);

        return $this;
    }

    public function value(): string
    {
        return $this->current;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function consoleAbout(): string
    {
        if (! $this->exists()) {
            return '<fg=red;options=bold>NOT INSTALLED</>';
        }

        if ($this->isLatest()) {
            return '<fg=green;options=bold>'.$this->value().'</>';
        }

        return '<fg=yellow;options=bold>'.$this->value().'</> < '
            .'<fg=green;>'.$this->latest().'</>';
    }
}
