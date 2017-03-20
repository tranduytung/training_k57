<?php

namespace App\Http;

use App\Contracts\ApiErrors;
use Illuminate\Http\JsonResponse;

class ApiResponse extends JsonResponse
{
    /**
     * @param string $errorCode
     * @return JsonResponse
     */
    public static function error($errorCode)
    {
        $data = [
            'success' => 0,
            'error' => ApiErrors::get($errorCode),
        ];

        return (new static($data, 200))
            ->header('Content-Type', 'application/json', true);
    }

    /**
     * @param mixed $data
     * @return JsonResponse
     */
    public static function success($data)
    {
        $success = 1;

        return (new static(compact('success', 'data'), 200))
            ->header('Content-Type', 'application/json', true);
    }
}
