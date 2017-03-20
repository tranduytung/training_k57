<?php
namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestResponse;

abstract class ApiTestCase extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @var User
     */
    protected $testUser;

    /**
     * @var string
     */
    protected $testAccessToken;

    /**
     * Make request call API
     * @param array $request Request data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    abstract protected function callApi(array $request = []): TestResponse;

    /**
     * @param \Illuminate\Foundation\Testing\TestResponse $response
     * @param string $errorCode
     */
    public function assertResponseError(TestResponse $response, $errorCode)
    {
        // Check HTTP status code
        $response->assertStatus(200);

        // check response json structure
        $response->assertJsonStructure([
            'success',
            'error' => [
                'error_code',
                'error_message',
            ],
        ]);

        // check error code
        $response->assertJson([
            'success' => 0,
            'error' => [
                'error_code' => $errorCode,
            ],
        ]);
    }

    /**
     * Setting up test user and access token
     */
    protected function setUp()
    {
        parent::setUp();

        // Insert test user
        $this->testUser = factory(User::class)->create();

        // Make access_token for test
        $this->testAccessToken = User::generateAccessToken(
            $this->testUser->email,
            $this->testUser->device_id,
            $this->testUser->device_type
        );

        // Update access_token for test
        $this->testUser->access_token = $this->testAccessToken;
        $this->testUser->save();
    }
}
