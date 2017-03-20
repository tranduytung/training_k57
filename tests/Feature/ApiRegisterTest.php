<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\ApiTestCase;

class ApiRegisterTest extends ApiTestCase
{
    /**
     * Make request call API
     * @param array $request Request data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function callApi(array $request = []): TestResponse
    {
        return $this->json('POST', '/api/user/register', $request);
    }

    /**
     * Make test data
     *
     * @return array
     */
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

    public function testSuccessCase()
    {
        // make test data
        $data = $this->makeTestData();

        // check event is fired
        $this->expectsEvents(Registered::class);
        $response = $this->callApi($data);

        $response->assertStatus(200);
        // check response json structure
        $response->assertJsonStructure([
            'success',
            'data' => [
                'token',
            ],
        ]);

        $response->assertJson(['success' => 1]);
    }

    /**
     * @param array $data
     * @param string $errorCode
     * @dataProvider missingFieldDataProvider
     */
    public function testMissingFieldCase($data, $errorCode)
    {
        // check event isn't fired
        $this->doesntExpectEvents(Registered::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, $errorCode);
    }

    public function testExistedEmailCase()
    {
        // Test data with existed email
        $data = array_merge($this->makeTestData(), ['email' => $this->testUser->email]);

        // check event isn't fired
        $this->doesntExpectEvents(Registered::class);

        // Call API
        $response = $this->callApi($data);

        // Check response
        $this->assertResponseError($response, 'E0008');
    }

    /**
     * @return array
     */
    public function missingFieldDataProvider()
    {
        return [
            [ // Case missing email
                array_except($this->makeTestData(), ['email']),
                'E0007',
            ],
            [ // Case missing password
                array_except($this->makeTestData(), ['password']),
                'E0010',
            ],
            [ // Case missing email and password
                array_except($this->makeTestData(), ['email', 'password']),
                'E0007',
            ],
            [ // Case email is empty
                array_merge($this->makeTestData(), ['email' => '']),
                'E0007',
            ],
            [ // Case password is empty
                array_merge($this->makeTestData(), ['password' => '']),
                'E0010',
            ],
            [ // Case email and password are empty
                array_merge($this->makeTestData(), ['email' => '', 'password' => '']),
                'E0007',
            ],
            [ // Case missing username
                array_except($this->makeTestData(), ['username']),
                'E0012',
            ],
            [ // Case empty username
                array_merge($this->makeTestData(), ['username' => '']),
                'E0012',
            ],
            [ // Case missing device_id
                array_except($this->makeTestData(), ['device_id']),
                'E0002',
            ],
            [ // Case empty device_id
                array_merge($this->makeTestData(), ['device_id' => '']),
                'E0002',
            ],
            [ // Case missing device_type
                array_except($this->makeTestData(), ['device_type']),
                'E0002',
            ],
            [ // Case empty device_type
                array_merge($this->makeTestData(), ['device_type' => '']),
                'E0002',
            ],
            [ // Case incorrect device_type
                array_merge($this->makeTestData(), ['device_type' => 5]),
                'E0002',
            ],
        ];
    }
}
