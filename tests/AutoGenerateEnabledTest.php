<?php

namespace Tests;

class AutoGenerateEnabledTest extends BaseTestCase
{
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
}
