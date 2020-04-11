<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use WyattCast44\LaravelSchema\Facades\LaravelSchema;
use WyattCast44\LaravelSchema\LaravelSchemaServiceProvider;

class PackageTests extends TestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [LaravelSchemaServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LaravelSchema' => LaravelSchema::class,
        ];
    }

    public function test_it_generates_schema_files_for_all_database_tables()
    {
        $this->artisan('migrate', ['--database' => 'testing']);
    }
}
