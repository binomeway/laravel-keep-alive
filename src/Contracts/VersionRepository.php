<?php

namespace BinomeWay\KeepAlive\Contracts;

interface VersionRepository
{
    public function set(string $value): bool|int;

    public function exists(): bool;

    public function get(?string $default = null): ?string;
}
