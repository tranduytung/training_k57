<?php

namespace App\Http\Controllers\Api;

use App\Http\ApiResponse;
use App\Http\Requests\Api;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 * @resource User
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get user API
     *
     * This API to get all information about an user
     *
     * @param Api\GetUserRequest $request
     * @return \App\Http\ApiResponse
     */
    public function get(Api\GetUserRequest $request)
    {
        // get user from token
        $user = Auth::user();

        // format data
        $data = fractal($user, new UserTransformer())->toArray();

        // SUCCESS
        return ApiResponse::success($data['data'] ?? new \stdClass());
    }

    /**
     * Update user profice API
     *
     * This API to update user profile
     *
     * @param Api\UpdateUserRequest $request
     * @return \App\Http\ApiResponse
     */
    public function update(Api\UpdateUserRequest $request)
    {
        //
    }

    /**
     * Update user social action API
     *
     * This API to update user social action
     *
     * @param Api\UpdateUserSocialActionRequest $request
     * @return \App\Http\ApiResponse
     */
    public function updateSocialAction(Api\UpdateUserSocialActionRequest $request)
    {
        //
    }

    /**
     * Donate API
     *
     * This API to add donation of user
     *
     * @param Api\UserDonate $request
     * @return \App\Http\ApiResponse
     */
    public function donate(Api\UserDonateRequest $request)
    {
        //
    }

    /**
     * Get user status API
     *
     * This API to get current month status of user
     *
     * @param Api\GetUserStatusRequest $request
     * @return \App\Http\ApiResponse
     */
    public function getStatus(Api\GetUserStatusRequest $request)
    {
        //
    }

    /**
     * Get dashboard API
     *
     * This API to get all info of user for dashboard
     *
     * @param Api\GetUserDashboardRequest $request
     * @return \App\Http\ApiResponse
     */
    public function getDashboard(Api\GetUserDashboardRequest $request)
    {
        //
    }
}
