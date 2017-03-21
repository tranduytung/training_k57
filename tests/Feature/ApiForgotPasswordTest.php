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
            'email' => $email,
        ];
    }

    public function testSuccessCase()
    {
        // make test data
        $data = array_merge($this->makeTestData(), ['email' => $this->testUser->email]);
       
        // check event is fired
        $response = $this->callApi($data);

        $response->assertStatus(200);
        // check response json structure
        $response->assertJsonStructure([
            'success'
        ]);

        $response->assertJson(['success' => 1]);
    }

    public function testUnExistedEmailCase()
    {
        // Test data with unexisted email
        $data = array_merge($this->makeTestData(), ['email' => 'mail_unexist@gmail.com']);

        // check event isn't fired
        $this->doesntExpectEvents(ForgotPassword::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, 'E0009');
    }
    
    public function testDelatedAtNotNulllCase()
    {
        // Test data with existed email and deleted_at not null
        $data = array_merge($this->makeTestData(), ['email' => $this->testUser->email]);
        $this->testUser->deleted_at = "2016/10/10";
        $this->testUser->save();

        // check event isn't fired
        $this->doesntExpectEvents(ForgotPassword::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, 'E0009');
    }

    /**
     * @param array $data
     * @param string $errorCode
     * @dataProvider missingFieldDataProvider
     */
    public function testMissingFieldCase($data, $errorCode)
    {
        // check event isn't fired
        $this->doesntExpectEvents(ForgotPassword::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, $errorCode);
    }
    
    public function missingFieldDataProvider()
    {
        $email = 'a123456789012345678901234567890';
        while(strlen($email) < 200) {
            $email = $email.$email;
        }
        return [
            [ // Case missing email
                array_except($this->makeTestData(), ['email']),
                'E0007',
            ],
            [ // Case email is empty
                array_merge($this->makeTestData(), ['email' => '']),
                'E0007',
            ],
            [ // Case invalid email 
                array_merge($this->makeTestData(), ['email' => 'mr.tester']),
                'E0007',
            ],
            [ // Case invalid email 
                array_merge($this->makeTestData(), ['email' => 'mr.tester@']),
                'E0007',
            ],
            [ // Case invalid email 
                array_merge($this->makeTestData(), ['email' => 'mr.tester@example']),
                'E0007',
            ],
            [ // Case invalid email 
                array_merge($this->makeTestData(), ['email' => 'mr.tester@example.']),
                'E0007',
            ],
            [ // Case invalid email 
                array_merge($this->makeTestData(), ['email' => $email.'@gmail.com']),
                'E0007'
            ],
        ];
    }
}
