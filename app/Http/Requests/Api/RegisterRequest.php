<?php

namespace App\Http\Requests\Api;

use App\Contracts\DBTable;
use App\Http\ApiRequest;

class RegisterRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:200|unique:' . DBTable::USER . ',email',
            'password' => 'required|min:6|max:20',
            'device_id' => 'required|string|max:255',
            'device_type' => 'required|in:1,2'
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function parseError(array $errors): string
    {
        if (isset($errors['email'])
            && count(array_except($errors['email'], 'Unique')) > 0
        ) {
            return 'E0007';
        }

        if (isset($errors['password'])) {
            return 'E0010';
        }

        if (isset($errors['username'])) {
            return 'E0012';
        }

        if (isset($errors['device_id']) || isset($errors['device_type'])) {
            return 'E0002';
        }

        if (isset($errors['email']['Unique'])) {
            return 'E0008';
        }

        return 'E0001';
    }
}
