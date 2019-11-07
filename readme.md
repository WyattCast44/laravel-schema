# Laravel Schema

This is a simple package to generate schemas of your database tables.

The problem that this package attempts to solve is: when developing a laravel
application and you want to check the fields in your table, it can be hard to
determine what fields are actually in the table at the current state, for
example you may have several migrations that add or remove columns. This package
will wait to all migrations have ran and then generate a schema based on the
current state of the database.

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

Via Composer

```bash
composer require wyattcast44/laravelschema
```

## Usage

## Change log

Please see the [changelog](changelog.md) for more information on what has
changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead
of using the issue tracker.

## Credits

-   [author name][link-author]
-   [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]:
    https://img.shields.io/packagist/v/wyattcast44/laravelschema.svg?style=flat-square
[ico-downloads]:
    https://img.shields.io/packagist/dt/wyattcast44/laravelschema.svg?style=flat-square
[ico-travis]:
    https://img.shields.io/travis/wyattcast44/laravelschema/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield
[link-packagist]: https://packagist.org/packages/wyattcast44/laravelschema
[link-downloads]: https://packagist.org/packages/wyattcast44/laravelschema
[link-travis]: https://travis-ci.org/wyattcast44/laravelschema
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/wyattcast44
[link-contributors]: ../../contributors
