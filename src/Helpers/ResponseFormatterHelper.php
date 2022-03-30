<?php

namespace Max26292\LaravelLazyTools\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseFormatterHelper
{
    /**
     * @param int $statusCode
     * @param array $data
     * @param array $messages
     * @return JsonResponse
     */
    public function responseSuccess(int $statusCode, array $data = [], array $messages = [])
    {
        return response()->json([
            'status'  => true,
            'message' => $messages,
            'data'    => $data
        ], $statusCode);
    }

    /**
     * @param int $statusCode
     * @param array $messages
     * @param array $data
     * @param string $errorCode
     * @return JsonResponse
     */
    public function responseError(int $statusCode, array $messages = [], array $data = [], $errorCode = 'ERR0')
    {
        return response()->json([
            'status'  => false,
            'code'    => $errorCode,
            'message' => $messages,
            'data'    => $data
        ], $statusCode);
    }
}
