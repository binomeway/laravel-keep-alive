<?php

namespace BinomeWay\KeepAlive\Concerns;

use BinomeWay\KeepAlive\Updater\Installer;
use BinomeWay\KeepAlive\Updater\Updater;

/**
 * @mixin Installer|Updater
 */
trait WithProgress
{
    protected function progressStart($max = 0): void
    {
        if (app()->runningInConsole()) {
            $this->command->getOutput()->progressStart($max);
        }
    }

    protected function progressAdvance(): void
    {
        if (app()->runningInConsole()) {
            $this->command->getOutput()->progressAdvance();
        }
    }

    protected function progressFinish(): void
    {
        if (app()->runningInConsole()) {
            $this->command->getOutput()->progressFinish();
        }
    }
}
