<?php

namespace BinomeWay\KeepAlive\Repositories;

use BinomeWay\KeepAlive\Contracts\VersionRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FileRepository implements VersionRepository
{
    public function set(string $value): bool|int
    {
        return \File::put($this->getFilePath(), $value);
    }

    public function exists(): bool
    {
        return \File::exists($this->getFilePath());
    }

    /**
     * @throws FileNotFoundException
     */
    public function get(?string $default = null): ?string
    {
        // If we have no current version it means that is a fresh installation
        // In this case we want the latest version

        return trim(\File::get($this->getFilePath())) ?? $default;
    }

    protected function getFilePath(): string
    {
        return storage_path('app/version');
    }
}
