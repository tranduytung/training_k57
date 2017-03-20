<?php

namespace App\Auth;

use Illuminate\Auth\TokenGuard as Guard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\UserProvider;

class TokenGuard extends Guard
{
    /**
     * Create a new authentication guard.
     *
     * @param UserProvider $provider
     * @param Request $request
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        parent::__construct($provider, $request);

        $this->inputKey = 'token';
        $this->storageKey = 'access_token';
    }

    /**
     * Get the token for the current request.
     *
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->request->query($this->inputKey);

        if (empty($token)) {
            $token = $this->request->input($this->inputKey);
        }

        return $token;
    }
}
