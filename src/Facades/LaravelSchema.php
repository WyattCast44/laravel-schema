<?php

namespace WyattCast44\LaravelSchema\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelSchema extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-schema';
    }
}
