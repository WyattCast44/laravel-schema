# Laravel Schema

This is a simple package to generate schema files for your database tables.

For an example, the standard `users` table in a new laravel application will
generate a file named `users.schema.json` that contains the contents below.

```json
{
  "name": "users",
  "schema": {
    "id": "bigint",
    "name": "string",
    "email": "string",
    "email_verified_at": "datetime",
    "password": "string",
    "remember_token": "string",
    "created_at": "datetime",
    "updated_at": "datetime"
  }
}
```

## Installation

```bash
composer require wyattcast44/laravelschema
```

## Usage

1. Schema files will be regenerated anytime you run migrations

2. You can manually trigger a build by running the command below

```bash
php artisan schema:generate
```

## Config

You can publish the config file using the command below

```bash
php artisan vendor:publish --provider="WyattCast44\LaravelSchema\LaravelSchemaServiceProvider"
```

Once you have published the config file you can customize:

- where the files will be generated, the default location is in
  `database\schemas`
- the file extension, the default is `.schema.json`
- you add any tables you would like to ignore

## Why

Have you ever needed to know what fields a certain table contains... so you open
up the create migration for that table? The problem is the more migrations you
have the better chance that the schema for that table has changed.

You are left with two options, go through every migration file (🤮), or open up
a database GUI (🙄).

I wanted a quick way to see the current table columns and data-types in my code
editor, this is how this package was born. I hope you might find it useful as
well :)

## Change log

Please see the [changelog](changelog.md) for more information on what has
changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead
of using the issue tracker.

## Credits

- [Wyatt Castaneda][https://github.com/wyattcast44]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.
