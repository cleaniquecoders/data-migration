<?php

namespace CleaniqueCoders\DataMigration\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CleaniqueCoders\DataMigration\DataMigration
 */
class DataMigration extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CleaniqueCoders\DataMigration\DataMigration::class;
    }
}
