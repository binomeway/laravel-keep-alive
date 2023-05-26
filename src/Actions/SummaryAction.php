<?php

namespace BinomeWay\KeepAlive\Actions;

use Artisan;
use BinomeWay\KeepAlive\Contracts\RunnableAction;
use BinomeWay\KeepAlive\Facades\Updater;

class SummaryAction implements RunnableAction
{
    public function run(): void
    {
        if (! app()->runningInConsole()) {
            return;
        }

        Artisan::call('about');

        Updater::command()?->info('🎉Application installed!');
    }
}
