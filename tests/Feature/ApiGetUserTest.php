<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestResponse;
use Tests\ApiTestCase;

class ApiGetUserTest extends ApiTestCase
{
    /**
     * Make request call API
     * @param array $request Request data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function callApi(array $request = []): TestResponse
    {
        return $this->json('GET', '/api/user', $request);
    }

    public function testSuccessCase()
    {
        $response = $this->callApi(['token' => $this->testAccessToken]);

        // Check success response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'user_id',
                'user_name',
                'email',
                'area_id',
                'avatar',
                'birthday',
                'gender',
                'social_action_id',
            ],
        ]);

        // Check response data
        $response->assertJson([
            'success' => 1,
            'data' => [
                'user_id' => $this->testUser->id,
            ],
        ]);
    }

    public function testMissingTokenCase()
    {
        $response = $this->callApi([]);

        // Check error
        $this->assertResponseError($response, 'E0003');
    }

    public function testUserNotFoundCase()
    {
        // Make a token, but without user
        $token = $this->testAccessToken . uniqid();

        $response = $this->callApi(['token' => $token]);

        // Check error
        $this->assertResponseError($response, 'E0003');
    }
}
