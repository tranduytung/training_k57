<?php

namespace App\Http\Requests\Api;

use App\Http\ApiRequest;

class GetUserRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function parseError(array $errors): string
    {
        if (isset($errors['token'])) {
            return 'E0003';
        }

        return 'E0001';
    }
}
