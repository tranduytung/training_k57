<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api;

class DonationController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * This Api get Donation Result by month and all
     *
     * @param Api\GetDonationsResultRequest $request
     * @return \App\Http\ApiResponse
     */
    public function getResult(Api\GetDonationsResultRequest $request)
    {
        //
    }

    /**
     * This Api send_dontaion
     *
     * @param Api\GetDonationsByDateRequest $request
     * @return @return \App\Http\ApiResponse
     */
    public function add(Api\GetDonationsByDateRequest $request)
    {
        //
    }
}
