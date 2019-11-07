<?php

namespace WyattCast44\LaravelSchema\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class GenerateDatabaseSchemaFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schema:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate schema files for all database tables.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = collect(DB::connection()->getDoctrineSchemaManager()->listTableNames());
    
        $tables->each(function ($table) {

            // Build up the file name
            $path = config('schema.path') . '/' . $table . config('schema.extension');

            $rows = [];

            foreach (Schema::getColumnListing($table) as $column) {
                $rows[$column] = Schema::getColumnType($table, $column);
            }

            $contents = [
                'name' => $table,
                'schema' => $rows
            ];
        
            $contents = json_encode($contents, JSON_PRETTY_PRINT);

            $this->ensureDirectoryExists();

            File::put($path, $contents);
        });
    }

    public function ensureDirectoryExists()
    {
        if (!is_dir(config('schema.path'))) {
            File::makeDirectory(config('schema.path'));
        }
    }
}
