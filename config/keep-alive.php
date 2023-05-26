<?php


use BinomeWay\KeepAlive\Actions\{RunMigrationsAction, SummaryAction};

return [

    /**
     * This represents the latest version of the application
     * Whenever the app requires to run updates, bump this version.
     */
    'version' => '0.0.0',

    'repository' => \BinomeWay\KeepAlive\Repositories\FileRepository::class,

    'install' => [
        RunMigrationsAction::class,
        SummaryAction::class,
    ],

    'updates' => [
        //  '1.0.0' => [Update100::class], // or just the class Update100::class
    ],

];
