<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use WyattCast44\LaravelSchema\LaravelSchemaServiceProvider;

class GenerateSchemasCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [LaravelSchemaServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('schema.auto_generate', false);

        $app['config']->set('schema.path',  __DIR__ . '/database/schemas');
    }

    public function test_it_generates_schema_files_for_all_database_tables_when_command_is_called()
    {
        $this->artisan('migrate', ['--database' => 'testing']);

        $this->assertFalse(file_exists(__DIR__ . '/database/schemas/users.schema.json'));
        $this->assertFalse(file_exists(__DIR__ . '/database/schemas/password_resets.schema.json'));

        $this->artisan('schema:generate');

        $this->assertTrue(file_exists(__DIR__ . '/database/schemas/users.schema.json'));
        $this->assertTrue(file_exists(__DIR__ . '/database/schemas/password_resets.schema.json'));
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Delete any generated files
        array_map('unlink', glob(__DIR__ . '/database/schemas/*.schema.json'));
    }
}
