<?php

namespace App\Http\Controllers\Api;

use App\Events\ForgotPassword;
use App\Events\PasswordWasReset;
use App\Http\ApiResponse;
use App\Http\Requests\Api;
use App\Models\User;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

class PasswordController extends Controller
{
    /**
     * Forgot password API
     *
     * @param Api\ForgotPasswordRequest $request
     * @return \App\Http\ApiResponse
     */
    public function forgot(Api\ForgotPasswordRequest $request)
    {
        // TODO: Check email existed
        $user = User::where('email', $request->input('email'))->first();
        if (!isset($user)) {
            return ApiResponse::error('E0009');
        }
        
        // TODO: fire event and send email
        event(new ForgotPassword($user));

        // TODO: return response
        return ApiResponse::success([]);
    }

    /**
     * Reset password API
     *
     * @param Api\ResetPasswordRequest $request
     * @return \App\Http\ApiResponse
     */
    public function reset(Api\ResetPasswordRequest $request)
    {
        // TODO: Find user by email
        // TODO: Check token
        // TODO: Change password
        // TODO: fire event
        // TODO: return response
    }
}
