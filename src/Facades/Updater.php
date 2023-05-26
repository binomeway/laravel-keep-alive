<?php

namespace BinomeWay\KeepAlive\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \BinomeWay\KeepAlive\Services\Updater
 */
class Updater extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \BinomeWay\KeepAlive\Services\Updater::class;
    }
}
