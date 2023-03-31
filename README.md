# Laravel Request Tracker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elwafa/laravek-request-tracker.svg?style=flat-square)](https://packagist.org/packages/elwafa/laravel-request-tracker)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elwafa/laravel-request-tracker.svg?style=flat-square)](https://packagist.org/packages/elwafa/laravel-request-tracker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/elwafa/laravel-request-tracker/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/elwafa/laravel-request-tracker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/elwafa/laravel-request-tracker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/elwafa/laravel-request-tracker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/elwafa/laravel-request-tracker.svg?style=flat-square)](https://packagist.org/packages/elwafa/laravel-request-tracker)
<!--delete-->
---
This repo can be used to scaffold a Laravel package. Follow these steps to get started:

1. Press the "Use this template" button at the top of this repo to create a new repo with the contents of this skeleton.
2. Run "php ./configure.php" to run a script that will replace all placeholders throughout all the files.
3. Have fun creating your package.
4. If you need help creating a package, consider picking up our <a href="https://laravelpackage.training">Laravel Package Training</a> video course.
---
<!--/delete-->
This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require elwafa/laravel-request-tracker
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-request-tracker-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-request-tracker-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-request-tracker-views"
```

## Usage

```php
$variable = new VendorName\Skeleton();
echo $variable->echoPhrase('Hello, VendorName!');
```

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

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
