<?php

namespace App\Http\Controllers\Api;

use App\Events\ForgotPassword;
use App\Events\PasswordWasReset;
use App\Http\ApiResponse;
use App\Http\Requests\Api;
use App\Models\User;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use App\Contracts\DBTable;

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
        $request->merge(['password_confirmation' => $request->input('password')]);
        $credentials = $request->only(
           'email', 'token', 'password', 'password_confirmation'
        );
        $response = Password::broker()->reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
            event(new PasswordWasReset($user));
        });

        if ($response == Password::INVALID_USER) {
            // email dose not exist
            return ApiResponse::error('E0009');
        }

        if ($response == Password::INVALID_PASSWORD) {
            // password invalid
            return ApiResponse::error('E0010');
        }

        if ($response == Password::INVALID_TOKEN) {
            // token invalid
            return ApiResponse::error('E0016');
        }
        return ApiResponse::success(null);
    }
}
