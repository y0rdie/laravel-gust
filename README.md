# Laravel Gust*

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sambindoff/laravel-gust/Tests?label=tests)](https://github.com/sambindoff/laravel-gust/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)
[![License](https://img.shields.io/packagist/l/sambindoff/laravel-gust)](https://packagist.org/packages/sambindoff/laravel-gust)

- [Introduction](#introduction)
    - [Installation](#installation)
        - [Install with Fortify](#install-with-fortify)
        - [Install with Breeze](#install-with-breeze)
        - [Install with UI](#install-with-ui)
    - [What this does to your application](#what-this-does-to-your-application)
        - [What all stacks do](#what-all-stacks-do)
        - [What the Fortify stack does](#what-the-fortify-stack-does)
        - [What the Breeze stack does](#what-the-breeze-stack-does)
        - [What the UI stack does](#what-the-ui-stack-does)
    - [Changelog](#changelog)
    - [Contributing](#contributing)
    - [Security Vulnerabilities](#security-vulnerabilities)
    - [Credits](#credits)
    - [License](#license)

## Introduction

Laravel Gust is a backend agnostic Vue.js authentication frontend for Laravel. Gust can power the registration and authentication features of your Laravel backend when using Laravel Fortify, Breeze or UI.

Gust is powered by Vue.js v2, Vue Router, Vuex and Tailwind CSS v2 on the frontend and provides scaffolding to get your started with a basic Vue.js SPA that is compatible with all Laravel backend authentication packages.

Gust uses Laravel Sanctum on the backend to authenticate your SPA regardless of the stack you choose.

You can read more about how to install each stack and the changes they make to your application below.

## Installation

You can install the package via composer:

```bash
composer require sambindoff/laravel-gust --dev
```

## Usage

Gust offers a choice of three backend stacks: Fortify, Breeze or UI (for you dinosaurs among us).

#### Install with Fortify

``` bash
php artisan gust:install fortify
```

Read about the changes this makes to your application in the [What the Fortify stack does](#what-the-fortify-stack-does) section below.

#### Install with Breeze

``` bash
php artisan gust:install breeze
```

Read about the changes this makes to your application in the [What the Breeze stack does](#what-the-breeze-stack-does) section below.

#### Install with UI

``` bash
php artisan gust:install ui
```

Read about the changes this makes to your application in the [What the UI stack does](#what-the-ui-stack-does) section below.

#### Finalising the Installation

``` bash
php artisan migrate
npm install && npm run dev
```

## What this does to your application

#### What all stacks do

In order for any SPA to be compatible with Laravel, here is an exhaustive list of all the changes required:

- Composer require the `laravel/sanctum` package.
- Run the Sanctum `vendor:publish` command.
- Add `SANCTUM_STATEFUL_DOMAINS` as an environment variable.
- Add the Sanctum middleware to `app/Http/Kernel.php`.
- Add the `MustVerifyEmail` interface to `app/Models/User.php`.
- Copy the `routes/api.php` and `routes/web.php` stubs.
- Delete the `resources/sass` directory.
- Delete the `resources/js/bootstrap.js` file.
- Delete the `resources/views` directory ready for the new stubs.
- Publish all the SPA stubs.
- Update `package.json` to require Vue.js, Vue Router, Vuex and Tailwind CSS.
- Override the reset password route in `app/Providers/AppServiceProvider.php` with a URL as this GET route definition no longer exists in a SPA.
- Replace the login route in `app/Http/Middleware/Authenticate.php` with a URL as this GET route definition no longer exists in a SPA.

#### What the Fortify stack does
- Composer require the `laravel/fortify` package.
- Run the Fortify `vendor:publish` command.
- Add the `FortifyServiceProvider` to the providers key in `config/app.php`.
- Copy the `config/fortify.php` stub which disables views and enables the registration, reset password and email verification features.
- Copy the `app/Providers/FortifyServiceProvider.php` stub which registers the `CreateNewUser` and `ResetUserPassword` action classes.
- Delete the `app/Actions/Fortify/UpdateUserPassword.php` file.
- Delete the `app/Actions/Fortify/UpdateUserProfileInformation.php` file.

You can find out more about Laravel Fortify in the [official repository](https://github.com/laravel/fortify).

#### What the Breeze stack does
- Run the Breeze `vendor:publish` command.
- Copy the `routes/auth-breeze.php` stubs to `routes/auth.php`.
- Copy the `app/Http/Controllers/Auth/ConfirmablePasswordController.php` stub. This explicitally uses the auth web guard for validating the user and throws a ValidationException if invalid which our SPA can interpret.
- Replace `Auth::logout` with `Auth::guard('web')->logout` in `app/Http/Controllers/Auth/AuthenticatedSessionController.php` to be explicit about the auth guard.
- Add the `use App\Providers\RouteServiceProvider;` import to `app/Http/Controllers/Auth/NewPasswordController.php` so it can be used as the redirect.
- Replace `redirect()->route('login')` with `redirect(RouteServiceProvider::HOME)` in `app/Http/Controllers/Auth/NewPasswordController.php`.
- Delete the `app/Views` directory.

You can find out more about Laravel Breeze in the [official repository](https://github.com/laravel/breeze).

#### What the UI stack does
- Composer require the `laravel/ui` package.
- Run the `ui:controllers` command.
- Copy the `routes/auth-ui.php` stubs to `routes/auth.php`.
- Copy the `app/Http/Controllers/Auth/LoginController.php` stub. This overrides the `logout` method explicitally uses the auth web guard.
- Delete the `app/Http/Controllers/HomeController.php` file.

You can find out more about Laravel UI in the [official repository](https://github.com/laravel/ui).

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
