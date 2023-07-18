# This package allows data migration from one source to another

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/data-migration.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/data-migration)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/data-migration/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/data-migration/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/data-migration/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cleaniquecoders/data-migration/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/data-migration.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/data-migration)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.
## Installation

You can install the package via composer:

```bash
composer require cleaniquecoders/data-migration
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="data-migration-config"
```

## Usage

Configure the connections to the database that you need to migrate from (the source) and it's destination in the `config/data-migration.php` in `connections` key.

Once that completed, update the `tables` configuration in `config/data-migration.php`. This is the mapping of the data migration from source table to destination table.

```php
'tables' => [
    '_source_table' => 'destination_table',
    'media' => 'app_media',
]...
```

At the moment, we only provide table to table migration. We are not yet implementing column mapping at this point.


To start migrate, run the following command:

```bash
php artisan migrate mysql pgsql
```

By default, the migration will query by chunk of 100. If you need to increase the numbers, you can provide the option:

```bash
php artisan migrate mysql pgsql --chunk=1000
```

> By increasing the chunk, it might impact the performance of the migration.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nasrul Hazim Bin Mohamad](https://github.com/cleaniquecoders)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
