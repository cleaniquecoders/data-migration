<?php

namespace CleaniqueCoders\DataMigration;

use CleaniqueCoders\DataMigration\Commands\DataMigrationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DataMigrationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('data-migration')
            ->hasConfigFile()
            ->hasMigration('create_data-migration_table')
            ->hasCommand(DataMigrationCommand::class);
    }
}
