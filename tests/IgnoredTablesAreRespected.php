<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use WyattCast44\LaravelSchema\LaravelSchemaServiceProvider;

class IgnoredTablesAreRespected extends TestCase
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
        $app['config']->set('schema.auto_generate', true);

        $app['config']->set('schema.path',  __DIR__ . '/database/schemas');

        $app['config']->set('schema.ignore',  [
            'password_resets'
        ]);
    }

    public function test_it_only_generates_schema_files_for_non_ignored_tables()
    {
        $this->artisan('migrate', ['--database' => 'testing']);

        $this->assertTrue(file_exists(__DIR__ . '/database/schemas/users.schema.json'));

        $this->assertFalse(file_exists(__DIR__ . '/database/schemas/password_resets.schema.json'));
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // Delete any generated files
        array_map('unlink', glob(__DIR__ . '/database/schemas/*.schema.json'));
    }
}
