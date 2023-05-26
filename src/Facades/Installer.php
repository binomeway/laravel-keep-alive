<?php

namespace BinomeWay\KeepAlive\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \BinomeWay\KeepAlive\Services\Installer
 */
class Installer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BinomeWay\KeepAlive\Services\Installer::class;
    }
}
