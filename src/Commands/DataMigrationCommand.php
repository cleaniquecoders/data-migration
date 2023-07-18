<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DataMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:migrate {source} {destination} {--chunk=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from target source to targetted destination.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! config('data-migration.enabled')) {
            $this->error('Data migration disabled. Nothing to do.');

            return;
        }
        $source = $this->argument('source');
        $destination = $this->argument('destination');

        $this->validateDatabaseConfig($source);
        $this->validateDatabaseConfig($destination);
        $this->setDatabaseConnection($source);
        $this->setDatabaseConnection($destination);

        $started = now();
        $this->comment('Migration started at '.$started->format('H:i:s'));

        if (config('data-migration.options.run-migration')) {
            $this->call('migrate', [
                '--database' => $destination,
            ]);
        }

        if (! config('data-migration.options.fk-check')) {
            Schema::connection($destination)
                ->disableForeignKeyConstraints();
            $this->comment('Disabled Foreign Key Check.');
            $this->newLine();
        }

        $this->copy($source, $destination);

        if (! config('data-migration.options.fk-check')) {
            Schema::connection($destination)
                ->enableForeignKeyConstraints();
            $this->comment('Enabled Foreign Key Check.');
            $this->newLine();
        }

        $ended = now();

        $this->comment('Migration ended at '.$ended->format('H:i:s'));
        $this->comment('Migration ran for '.$ended->diffInSeconds($started).' seconds');
    }

    private function validateDatabaseConfig($value)
    {
        if (! in_array($value, array_keys(config('data-migration.connections')))) {
            $this->error("Unsupported $value database connection.");
            exit;
        }
    }

    private function setDatabaseConnection($value)
    {
        config([
            "database.connections.$value" => config("data-migration.connections.$value"),
        ]);
    }

    private function hasTable($connection, $table)
    {
        return Schema::connection($connection)->hasTable($table);
    }

    private function hasPrimaryKey($connection, $table)
    {
        return Schema::connection($connection)->hasColumn($table, 'id');
    }

    private function getOrderBy($connection, $table)
    {
        return ! $this->hasPrimaryKey($connection, $table)
            ? Schema::connection($connection)->getColumnListing($table)[0]
            : 'id';
    }

    private function copy($source, $destination)
    {
        foreach (config('data-migration.tables') as $source_table => $destination_table) {

            if (! $this->hasTable($source, $source_table)) {
                $this->warn("$source_table did not exits. Skip the migration.");

                continue;
            }

            if (! $this->hasTable($destination, $destination_table)) {
                $this->warn("$destination_table did not exits. Skip the migration.");

                continue;
            }

            $this->info("Migrating $source_table to $destination_table");

            if (config('data-migration.options.truncate')) {
                DB::connection($destination)
                    ->table($destination_table)
                    ->truncate();
                $this->line("Truncate $destination_table");
            }

            DB::connection($source)
                ->table($source_table)
                ->orderBy(
                    $this->getOrderBy($source, $source_table)
                )
                ->chunk(
                    $this->option('chunk'),
                    function (Collection $rows) use ($destination, $destination_table) {
                        DB::connection($destination)
                            ->table($destination_table)
                            ->insert(
                                json_decode($rows->toJson(), JSON_OBJECT_AS_ARRAY) // force as array
                            );
                    }
                );
            $this->newLine();
        }
    }
}
