# Keep your laravel applications through updates.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/binomeway/laravel-keep-alive.svg?style=flat-square)](https://packagist.org/packages/binomeway/laravel-keep-alive)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/binomeway/laravel-keep-alive/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/binomeway/laravel-keep-alive/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/binomeway/laravel-keep-alive/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/binomeway/laravel-keep-alive/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/binomeway/laravel-keep-alive.svg?style=flat-square)](https://packagist.org/packages/binomeway/laravel-keep-alive)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-keep-alive.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-keep-alive)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require binomeway/laravel-keep-alive
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-keep-alive-config"
```

This is the contents of the published config file:

```php
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
```

## Usage

Keep Alive extends the about command showing details about the app version state.

```shell
php artisan about
```

To install the application use `app:install`

```shell
php artisan app:install
```

To run updates use `app:update`

```shell
php artisan app:update
```

### Extending

Keep Alive can be used outside of a console context too.

For example if you want to call the install or update function you can use the Installer and Updater facades.

```php
use BinomeWay\KeepAlive\Facades;

function someMethod() {
    
    $result = Facades\Installer::run();
    
    // or same with Updater...
    
    $result = Facades\Updater::run();
    
    
    if($result->isSuccessful()) {
        // do something
        echo $result->message();
    }
    
    
}

```

### Repositories

In order to persist the app's version you can use one of the default repositories or implement your own

Default repositories:

- `FileRepository` (Default)
- `CacheRepository`
- `RedisRepository` (TODO)
- `EnvRepository` (TODO)

## Testing

```bash
composer test
```

## Roadmap

- [ ] Add support for prerequisites for Installer and Updater
- [ ] Add database transactions feature flag
- [ ] Add support to separate actions for each environment
- [ ] Add RedisRepository
- [ ] Add EnvRepository
- [ ] Add Filament extension
- [ ] Add Install/Update UI extension

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Codrin Axinte](https://github.com/codrin-axinte)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
