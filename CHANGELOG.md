# Changelog

All notable changes to `laravel-gust` will be documented in this file.

## [Unreleased](https://github.com/sambindoff/laravel-gust/compare/v1.1.1...main)

## v1.1.1 - 2021-03-24

### Fixed

- Breeze password reset SPA compatibility ([2b64c34](https://github.com/sambindoff/laravel-gust/commit/2b64c345f503b73b58d7986e2806519b1cf4faa4))

## v1.1.0 - 2021-03-24

### Changed

- Upgrade to Vue.js v3 including supporting libraries ([#7](https://github.com/sambindoff/laravel-gust/pull/7))

## v1.0.0 - 2021-01-05

### Changed

- Upgrade to Mix v6 ([#5](https://github.com/sambindoff/laravel-gust/pull/5))

## v0.3.0 - 2020-12-22

### Changed

- Breeze SPA compatibility updates [https://github.com/laravel/breeze/pull/29](https://github.com/laravel/breeze/pull/29) ([#3](https://github.com/sambindoff/laravel-gust/pull/3))

## v0.2.3 - 2020-12-18

### Changed

- Move customising the reset password url to the AuthServiceProvider ([f45d3ef](https://github.com/sambindoff/laravel-gust/commit/f45d3ef7b064dd122d032d926ecb9138fc5b2529))

## v0.2.2 - 2020-12-18

### Fixed

- Route reference still needs replacing for Fortify ([6754775](https://github.com/sambindoff/laravel-gust/commit/67547753a2f0ce43e7740289da1f99ad28452172))

## v0.2.1 - 2020-12-17

### Changed

- Replace fortify stubs with replace in file calls ([f045464](https://github.com/sambindoff/laravel-gust/commit/f04546495e96ba71ad9f5d3de4311441d6832663))

## v0.2.0 - 2020-12-16

### Changed

- Simplified `ConfirmablePasswordController` stub ([0d6f16d](https://github.com/sambindoff/laravel-gust/commit/0d6f16d17b269af1ba811dce4f763601c603e59e))
- Name register and login routes ([021121d](https://github.com/sambindoff/laravel-gust/commit/021121da4140cad526afc36638f59afa2fdec482))
- Delete views directory for all stacks once in the install SPA stack method ([4f6486b](https://github.com/sambindoff/laravel-gust/commit/4f6486b318f8be67e95f0e4cab767ce7eee7871f))
- Run the `ui:controllers` command instead of `ui:auth` as we only need the backend ([4f6486b](https://github.com/sambindoff/laravel-gust/commit/4f6486b318f8be67e95f0e4cab767ce7eee7871f))
- Lots more info added to README.md

## v0.1.2 - 2020-12-04

### Fixed

- UI must be installed in the project ([17bd446](https://github.com/sambindoff/laravel-gust/commit/17bd44622e130d697445dbf3e49ab350ecf1b63e))

## v0.1.1 - 2020-12-03

### Added

- Delete views directory for all stacks

## v0.1.0 - 2020-12-03

- Initial release
