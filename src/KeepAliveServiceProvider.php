<?php

namespace BinomeWay\KeepAlive;


use BinomeWay\KeepAlive\Commands\AppInstallCommand;
use BinomeWay\KeepAlive\Commands\AppUpdateCommand;
use BinomeWay\KeepAlive\Contracts\VersionRepository;
use BinomeWay\KeepAlive\Services\{Installer, Updater, Version};
use Closure;
use Illuminate\Foundation\Console\AboutCommand;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KeepAliveServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-keep-alive')
            ->hasConfigFile()
            ->hasCommands([
                AppInstallCommand::class,
                AppUpdateCommand::class,
            ]);
    }

    public function registeringPackage(): void
    {
        $this->app->singleton(VersionRepository::class, function ($app) {
            $repository = $app['config']->get('laravel-keep-alive.repository');

            return new $repository();
        });

        $this->app->singleton(Version::class, function ($app) {
            $version = $app['config']->get('laravel-keep-alive.version');

            return new Version(
                repository: $app[VersionRepository::class],
                latestVersion: $version
            );
        });

        $this->app->singleton(Installer::class, function ($app) {
            $steps = $app['config']->get('laravel-keep-alive.install');

            return new Installer($steps);
        });

        $this->app->singleton(Updater::class, function ($app) {
            $updates = $app['config']->get('laravel-keep-alive.updates');

            return new Updater($updates);
        });
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function booted(Closure $callback): void
    {
        if ($this->app->runningInConsole()) {
            AboutCommand::add(
                section: 'Environment',
                data: 'App Version',
                value: Facades\Version::consoleAbout()
            );
        }
    }
}
