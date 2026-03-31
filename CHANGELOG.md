# Changelog

All notable changes to `data-migration` will be documented in this file.

## 1.3.0 - 2026-03-31

### What's Changed

#### Added

- Laravel 13 support (illuminate constraints include `^13.0`)
- PHPUnit 12 compatibility
- Pest 4 support

#### Changed

- Updated `phpunit.xml.dist` for PHPUnit 12
- Standardized CI workflow (Laravel 12 + PHP 8.4/8.3)
- Updated dev dependencies (larastan, phpstan plugins, collision)

**Full Changelog**: https://github.com/cleaniquecoders/data-migration/compare/1.2.0...1.3.0

## Added Laravel 12 and PHP 8.4 Support - 2025-05-01

**Full Changelog**: https://github.com/cleaniquecoders/data-migration/compare/1.1.0...1.2.0

## Added Laravel 11 Support - 2024-03-21

**Full Changelog**: https://github.com/cleaniquecoders/data-migration/compare/1.0.1...1.1.0

## 1.0.1 - 2023-07-18

- Update README

**Full Changelog**: https://github.com/cleaniquecoders/data-migration/compare/1.0.0...1.0.1

## 1.0.0 - 2023-07-18

### Features

- Support truncate table before migration
- Support disable/enable foreign key check
- Support table-to-table migration
- Support common database drivers supported by Laravel
- Support running Laravel migration before executing the data migration

### What's Changed

- Bump aglipanci/laravel-pint-action from 2.2.0 to 2.3.0 by @dependabot in https://github.com/cleaniquecoders/data-migration/pull/1

### New Contributors

- @dependabot made their first contribution in https://github.com/cleaniquecoders/data-migration/pull/1

**Full Changelog**: https://github.com/cleaniquecoders/data-migration/commits/1.0.0
