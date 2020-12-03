# Laravel Gust*

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sambindoff/laravel-gust/Tests?label=tests)](https://github.com/sambindoff/laravel-gust/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)
[![License](https://img.shields.io/packagist/l/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)

## Introduction

Laravel Gust is a backend agnostic VueJS authentication frontend for Laravel. Gust can power the registration and authentication features of your Laravel backend when using Laravel Fortify, Breeze or UI.

## Installation

You can install the package via composer:

```bash
composer require sambindoff/laravel-gust --dev
```

## Usage

Gust offers a choice of three backend stacks: Fortify, Breeze or UI (for you dinosaurs among us).

### Install Gust with Fortify

``` bash
php artisan gust:install fortify
```

### Install Gust with Breeze

``` bash
php artisan gust:install breeze
```

### Install Gust with UI

``` bash
php artisan gust:install ui
```

### Finalising the Installation

``` bash
npm install && npm run dev
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Loris Leiva - Unlock your frontend skills](https://lorisleiva.com/unlock-your-frontend-skills/)
- [Markus Oberlehner - Implementing a Simple Middleware with Vue Router](https://markus.oberlehner.net/blog/implementing-a-simple-middleware-with-vue-router/)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

***This package might have a catchy one word name just like many other first party Laravel packages, however, this is most definitely an unoffical package and in no way endorsed by the Laravel team. It's more of a tongue-in-cheek reference, but hopefully just as brilliant.**
