<?php

namespace App\Contracts;

class ApiErrors
{
    public static $messages = [
        'E0001' => 'Server internal error',
        'E0002' => 'Device Info is invalid',
        'E0003' => 'Access Token is invalid',
        'E0004' => 'Access Token is expired',
        'E0005' => 'Permission denied',
        'E0006' => 'Resource not found',
        'E0007' => 'Email field is invalid',
        'E0008' => 'Email existed',
        'E0009' => 'Email does not exist',
        'E0010' => 'Password field is invalid',
        'E0011' => 'Email or password is incorrect',
        'E0012' => 'Name field is invalid',
        'E0013' => 'Birthday is invalid',
        'E0014' => 'Area code is invalid',
        'E0015' => 'Point is insufficient',
    ];

    /**
     * @param string $code
     * @return array
     */
    public static function get($code)
    {
        $message = static::$messages[$code] ?? 'Unknown error';

        return [
            'error_code' => $code,
            'error_message' => $message,
        ];
    }
}
