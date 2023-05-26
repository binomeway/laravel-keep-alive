<?php

namespace BinomeWay\KeepAlive\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \BinomeWay\KeepAlive\Services\Version
 */
class Version extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BinomeWay\KeepAlive\Services\Version::class;
    }
}
