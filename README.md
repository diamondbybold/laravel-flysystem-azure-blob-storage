# Laravel Flysystem Azure Blob Storage

[![Latest Version on Packagist](https://img.shields.io/packagist/v/diamondbybold/laravel-flysystem-azure-blob-storage.svg?style=flat-square)](https://packagist.org/packages/diamondbybold/laravel-flysystem-azure-blob-storage)
[![Build Status](https://img.shields.io/travis/diamondbybold/laravel-flysystem-azure-blob-storage/master.svg?style=flat-square)](https://travis-ci.org/diamondbybold/laravel-flysystem-azure-blob-storage)
[![Quality Score](https://img.shields.io/scrutinizer/g/diamondbybold/laravel-flysystem-azure-blob-storage.svg?style=flat-square)](https://scrutinizer-ci.com/g/diamondbybold/laravel-flysystem-azure-blob-storage)
[![Total Downloads](https://img.shields.io/packagist/dt/diamondbybold/laravel-flysystem-azure-blob-storage.svg?style=flat-square)](https://packagist.org/packages/diamondbybold/laravel-flysystem-azure-blob-storage)


A Laravel wrapper for [Flysystem Azure Blob Storage](https://flysystem.thephpleague.com/docs/adapter/azure/) adapter.

Includes:

* A Service Provider for Laravel
    * adding an `azure` disk for Laravel's File Storage abstraction of [Flysystem](https://github.com/thephpleague/flysystem)
* Integration with [Spatie's Media Library](https://docs.spatie.be/laravel-medialibrary) providing
    * a `AzureBlobUrlGenerator` (https://docs.spatie.be/laravel-medialibrary/v7/advanced-usage/generating-custom-urls)

## Installation

You can install the package via composer:

```bash
composer require diamondbybold/laravel-flysystem-azure-blob-storage
```

## Usage

The Service Provider is automatically registered on Laravel >= 5.5.

Configure your disk in `config/filesystem.php`

``` php
    'disks' => [

        'azure'  => [
            'driver' => 'azure',
            'account' => [
                'name' => env('AZURE_ACCOUNT_NAME'),
                'key' => env('AZURE_ACCOUNT_KEY'),
            ],
            'url' => env('AZURE_STORAGE_URL', null),
            'endpoint-suffix' => env('AZURE_ENDPOINT_SUFFIX', 'core.windows.net'),
            'container' => env('AZURE_CONTAINER', 'public')
        ]

    ]
```

### For integration with Media Library

Install and configure Media Library.

Add the following to `config/medialibrary.php`

```php
    'azure' => [
        'domain'    => 'https://' . env('AZURE_ACCOUNT_NAME') . '.blob.' . env('AZURE_ENDPOINT_SUFFIX') .
            '/' . env('AZURE_CONTAINER'),
    ],

     /*
      * When urls to files get generated, this class will be called. Leave empty
      * if your files are stored locally above the site root or on s3.
      */
    'url_generator' => env('MEDIA_LIBRARY_DISK_NAME', 'public') == 'azure'
        ? \DiamondByBOLD\FlysystemAzureBlobStorage\MediaLibrary\UrlGenerator\AzureBlobUrlGenerator::class
        : null,
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email digital@diamondbybold.com instead of using the issue tracker.

## Credits

* [João Machado](https://github.com/joaoffm)
* [All Contributors](../../contributors)

This package was made based on [A skeleton repository for Spatie's PHP Packages](https://github.com/spatie/skeleton-php).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
