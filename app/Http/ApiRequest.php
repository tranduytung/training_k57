<?php

namespace App\Http;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->isApiRequest()) {
            throw new ValidationException(
                $validator,
                ApiResponse::error($this->parseError($validator->failed()))
            );
        }

        parent::failedValidation($validator);
    }

    /**
     * Parse validate errors to API error
     *
     * @param array $errors
     * @return string API Error code
     */
    abstract protected function parseError(array $errors): string;
}
