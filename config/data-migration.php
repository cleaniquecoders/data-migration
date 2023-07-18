<?php

return [
    'enabled' => env('DATA_MIGRATION_ENABLED', false),
    'options' => [
        // Truncate before run the migrations. Default is true.
        'truncate' => env('DATA_MIGRATE_TRUNCATE', true),

        // Set to true if need to enable foreign key check. Default is false.
        'fk-check' => env('DATA_MIGRATION_FK_CHECK', false),

        // Run migration on destination database
        'run-migration' => env('DATA_MIGRATION_RUN', false),
    ],
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_MYSQL_HOST', '127.0.0.1'),
            'port' => env('DB_MYSQL_PORT', '3306'),
            'database' => env('DB_MYSQL_DATABASE', 'forge'),
            'username' => env('DB_MYSQL_USERNAME', 'forge'),
            'password' => env('DB_MYSQL_PASSWORD', ''),
            'unix_socket' => env('DB_MYSQL_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_PGSQL_HOST', '127.0.0.1'),
            'port' => env('DB_PGSQL_PORT', '5432'),
            'database' => env('DB_PGSQL_DATABASE', 'forge'),
            'schema' => env('DB_PGSQL_SCHEMA', 'public'),
            'username' => env('DB_PGSQL_USERNAME', 'forge'),
            'password' => env('DB_PGSQL_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],
    ],
    // Set your migration table mapping.
    // Do priortise table based on Primary Key & Foreign Key
    // usage to avoid failure during migration.
    'tables' => [
        // Default Laravel
        'users' => 'users',
        'sessions' => 'sessions',
        'migrations' => 'migrations',
        'notifications' => 'notifications',
        'failed_jobs' => 'failed_jobs',
    ],
];
