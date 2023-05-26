<?php

namespace BinomeWay\KeepAlive\Actions;

use Artisan;
use BinomeWay\KeepAlive\Contracts\RunnableAction;

class RunMigrationsAction implements RunnableAction
{
    public function run(): void
    {
        if (app()->environment('local')) {
            Artisan::call('migrate:fresh', [
                '--no-interaction' => true,
            ]);
        } else {
            Artisan::call('migrate', [
                '--no-interaction' => true,
            ]);
        }

    }
}
