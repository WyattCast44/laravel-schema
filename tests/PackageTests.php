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

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('schema.path',  __DIR__ . '/database/schemas');
    }

    public function test_it_generates_schema_files_for_all_database_tables()
    {
        // Given we have auto_generate enabled
        putenv('AUTOGENERATE_SCHEMA_FILES');

        // And given that the database has migrated
        $this->artisan('migrate', ['--database' => 'testing']);

        // We expect to see two schema files, one for the users table 
        // and one for the password resets table
        $this->assertTrue(file_exists(__DIR__ . '/database/schemas/users.schema.json'));
        $this->assertTrue(file_exists(__DIR__ . '/database/schemas/password_resets.schema.json'));
    }
}
