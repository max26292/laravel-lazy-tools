<?php

namespace Max26292\LaravelLazyTools\Facades;

use Illuminate\Support\Facades\Facade;

class ResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'response-formatter-helper';
    }
}