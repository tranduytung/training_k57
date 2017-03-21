<?php

namespace App\Http\Controllers\Api;

use App\Events\ForgotPassword;
use App\Events\PasswordWasReset;
use App\Http\ApiResponse;
use App\Http\Requests\Api;
use App\Models\User;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Support\Facades\Password;

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
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = Password::broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? ApiResponse::success(null)
                    : ApiResponse::error('E0009');
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
