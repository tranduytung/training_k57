<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api;

class AdvertisementController extends Controller
{
    /**
     * Get Advertisement API
     *
     * This API used to get random advertising product information
     *
     * @param Api\GetAdvertisementRequest $request
     * @return \App\Http\ApiResponse
     */
    public function get(Api\GetAdvertisementRequest $request)
    {
        // TODO: Get a random record in the mtb_advertisement
        // TODO: Format data
        // TODO: return response
    }
}
