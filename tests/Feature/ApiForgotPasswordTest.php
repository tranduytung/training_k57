<?php

namespace Tests\Feature;

use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Events\ForgotPassword;
use Illuminate\Foundation\Testing\TestResponse;

class ApiForgotPasswordTest extends ApiTestCase
{
    /**
     * Make request call API
     * @param array $request Request data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function callApi(array $request = []): TestResponse
    {
        return $this->json('POST', '/api/password/forgot', $request);
    }
    
    protected function makeTestData()
    {
        $email = 'mr.tester@example.xyz';

        return [
            'username' => 'Mr. Tester',
            'email' => $email,
            'password' => 'a123456789',
            'device_id' => str_random(40),
            'device_type' => rand(1, 2),
        ];
    }
    
    protected function makeTestMailData()
    {
        $email = 'mr.tester@example.xyz';

        return [ 
            'email' => $email,
        ];
    }
    
    public function testSuccessCase()
    {
        // make test data
        $data = $this->makeTestData();

        $this->call('POST', 'api/user/register/', $data);
        // check event is fired
        $this->expectsEvents(ForgotPassword::class);
        $response = $this->callApi($this->makeTestMailData());

        $response->assertStatus(200);
        // check response json structure
        $response->assertJsonStructure([
            'success'
        ]);

        $response->assertJson(['success' => 1]);
    }
    
    public function testMissingMailCase()
    {
        return [
            [ // Case missing email
                array_except($this->makeTestMailData(), ['email']),
                'E0007',
            ],
            [ // Case email is empty
                array_merge($this->makeTestMailData(), ['email' => '']),
                'E0007',
            ],
        ];
    }
    
    public function testUnExistedEmailCase()
    {
        // Test data with unexisted email
        $data = array_merge($this->makeTestMailData(), ['email' => 'mail_unexist@gmail.com']);

        // check event isn't fired
        $this->doesntExpectEvents(ForgotPassword::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, 'E0009');
    }
}
