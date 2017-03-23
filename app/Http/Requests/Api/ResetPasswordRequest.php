<?php

namespace App\Http\Requests\Api;

use App\Http\ApiRequest;

class ResetPasswordRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|max:200',
            'password' => 'required|min:6|max:20',
            'token' => 'required'
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function parseError(array $errors): string
    {
        if (isset($errors['email'])) {
            return 'E0007';
        }

        if (isset($errors['password'])) {
            return 'E0010';
        }

        if (isset($errors['token'])) {
            return 'E0003';
        }

        return 'E0001';
    }
}
