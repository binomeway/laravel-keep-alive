<?php

namespace BinomeWay\KeepAlive\Repositories;

use BinomeWay\KeepAlive\Contracts\VersionRepository;
use Cache;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class CacheRepository implements VersionRepository
{
    protected static string $cacheKey = 'app-version';

    public function set(string $value): bool|int
    {
        return Cache::rememberForever(static::$cacheKey, fn () => $value);
    }

    public function exists(): bool
    {
        return Cache::has(static::$cacheKey);
    }

    /**
     * @throws FileNotFoundException
     */
    public function get(?string $default = null): ?string
    {
        // If we have no current version it means that is a fresh installation
        // In this case we want the latest version

        return Cache::get(static::$cacheKey, $default);
    }
}
