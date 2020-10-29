# Laravel Schema

[![Latest Stable Version](https://poser.pugx.org/wyattcast44/laravelschema/v)](//packagist.org/packages/wyattcast44/laravelschema)
[![Total Downloads](https://poser.pugx.org/wyattcast44/laravelschema/downloads)](//packagist.org/packages/wyattcast44/laravelschema)

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

- Whether or not to automatically generate schema files when migrations are ran
- where the files will be generated, the default location is in `database\schemas`
- the file extension, the default is `.schema.json`
- you add any tables you would like to ignore

## Why

This package helps you quickly and easily determine what
field all your database tables have and the datatype for
those fields. 

As a project grows generally the number of migrations 
does as well, this can make it hard to determine by looking in 
one place what the final structure of a table is. You could 
open a database GUI and look there, but I wanted an easier way 
without leaving my code editor.

I hope you find this package useful in your workflow, I know
I use it daily in mine :)

## Change log

Please see the [changelog](changelog.md) for more information on what has
changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead
of using the issue tracker.

## Credits

- [Wyatt Castaneda](https://github.com/wyattcast44)
- [All Contributors](https://github.com/WyattCast44/laravel-schema/graphs/contributors)

## License

MIT. Please see the [license file](license.md) for more information.
