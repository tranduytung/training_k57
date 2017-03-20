<?php

namespace App\Http\Controllers\Api;

use App\Http\ApiResponse;
use App\Http\Requests\Api;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api
 * @resource Authentication
 */
class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    /**
     * Register API
     *
     * This API to register new account
     *
     * @param Api\RegisterRequest $request
     * @return \App\Http\ApiResponse
     */
    public function register(Api\RegisterRequest $request)
    {
        // Generate access_token
        $token = User::generateAccessToken(
            $request->input('email'),
            $request->input('device_id'),
            $request->input('device_type')
        );

        // TODO: move process create user to repository class
        $user = new User($request->only('username', 'email', 'device_id', 'device_type'));
        $user->password = $request->input('password');
        $user->access_token = $token;

        if (!$user->saveOrFail()) {
            return ApiResponse::error('E0001');
        }

        // fire event
        event(new Registered($user));

        // SUCCESS
        return ApiResponse::success(compact('token'));
    }

    /**
     * Authenticate API
     *
     * This API to authenticate and get access token
     *
     * @param Api\LoginRequest $request
     * @return \App\Http\ApiResponse
     */
    public function login(Api\LoginRequest $request)
    {
        // TODO: Check email existed
        // TODO: Check password
        // TODO: Check device info
        // TODO: Update token
        // TODO: fire event
        // TODO: return response
    }

    /**
     * Logout API
     *
     * This API to authenticate and get access token
     *
     * @param Api\LogoutRequest $request
     * @return \App\Http\ApiResponse
     */
    public function logout(Api\LogoutRequest $request)
    {
        // TODO: get user by token
        // TODO: clear access_token
        // TODO: fire event
        //event(new Logout($user));
        // TODO: return response
    }
}
