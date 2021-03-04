<?php

namespace Tests;

use Orchestra\Testbench\TestCase;
use WyattCast44\LaravelSchema\LaravelSchemaServiceProvider;

class AutoGenerateEnabledTest extends TestCase
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

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('schema.auto_generate', true);

        $app['config']->set('schema.path',  __DIR__ . '/database/schemas');
    }

    public function test_it_generates_schema_files_for_all_database_tables()
    {
        $this->artisan('migrate', ['--database' => 'testing']);
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
