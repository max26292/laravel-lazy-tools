<?php

namespace Max26292\LaravelLazyTools\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Http\JsonResponse;
/**
 * @method static JsonResponse responseSuccess(int $statusCode, array $data = [], array $messages = [])
 * @method static JsonResponse responseError(int $statusCode, array $messages = [], array $data = [], $errorCode = 'ERR0')
 */
class ResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'response-formatter-helper';
    }
}