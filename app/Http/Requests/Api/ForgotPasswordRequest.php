<?php

namespace App\Http\Requests\Api;

use App\Http\ApiRequest;

class ForgotPasswordRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:200',
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

        return 'E0001';
    }
}
