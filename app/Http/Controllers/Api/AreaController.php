<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api;

class AreaController extends Controller
{
    /**
     * AreaController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * List Area API
     *
     * This API used to retrieve area information
     *
     * @param Api\GetListAreaRequest $request
     * @return \App\Http\ApiResponse
     */
    public function getList(Api\GetListAreaRequest $request)
    {
        // TODO: retrieve list Area
        // TODO: Format data
        // TODO: return response
    }
}
