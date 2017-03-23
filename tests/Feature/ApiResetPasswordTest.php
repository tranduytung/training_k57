<?php

namespace Tests\Feature;

use Tests\ApiTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Events\PasswordWasReset;
use Illuminate\Foundation\Testing\TestResponse;

use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Support\Facades\DB;

class ApiResetPasswordTest extends ApiTestCase
{
//    /**
//     * @var TokenRepositoryInterface
//     */
//    protected $tokens;
//
//    /**
//     * @param TokenRepositoryInterface $tokens
//     * TokenRepositoryInterface don't work here
//     * 
//     */
//      public function __construct(TokenRepositoryInterface $tokens)
//      {
//      $this->tokens = $tokens;
//      }
    protected function setUp()
    {
        parent::setUp();
        $request = [
            'email' => $this->testUser->email
        ];
        $this->json('POST', '/api/password/forgot', $request);
    }

    /**
     * Make request call API
     * @param array $request Request data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function callApi(array $request = []): TestResponse
    {
        return $this->json('POST', '/api/password/reset', $request);
    }

    protected function makeTestData()
    {
        $email = 'mr.tester@example.xyz';
        $token = 'aaaaaaaaaaaaaaaaadiahsdashdasd8asd8';
        $password = '12345678';

        return [ 
            'email' => $email,
            'token' => $token,
            'password' => $password,
        ];
    }

    public function testSuccessCase()
    {
        // Make test data
        $token = app('auth.password.broker')->createToken($this->testUser);
//        $a = DB::table('dtb_password_reset')->where('email', $this->testUser->email)->first();
        $data = array_merge($this->makeTestData(), [
            'email' => $this->testUser->email,
            'token' => $token,
        ]);
//       print_r('tung');
//       
//        print_r($token);

        // check event is fired
        $response = $this->callApi($data);

        $response->assertStatus(200);
        // check response json structure
        $response->assertJsonStructure([
            'success'
        ]);

        $response->assertJson(['success' => 1]);
    }

//    public function testUnExistEmailCase()
//    {
//        // Test data with unexisted email
//        $data = array_merge($this->makeTestData(), ['email' => 'mail_unexist@gmail.com']);
//
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, 'E0009');
//    }
//
//    public function testDelatedAtNotNulllCase()
//    {
//        // Test data with existed email and deleted_at not null
//        $data = array_merge($this->makeTestData(), [
//            'email' => $this->testPasswordReset->email,
//            'token' => $this->testPasswordReset->token,
//        ]);
//        $this->testUser->deleted_at = "2016/10/10";
//        $this->testUser->save();
//
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, 'E0009');
//    }
//
//    public function testUnExistTokenCase()
//    {
//        // Test data with unexisted token
//        $data = array_merge($this->makeTestData(), [
//            'email' => $this->testPasswordReset->email,
//            'token' => '111111222222223gigf8sdfg8sdfg8'
//        ]);
//
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, 'E0016');
//    }
//
//    public function testPastTheDeadlineCase()
//    {
//        // make PasswordReset have created_at not true
//        $this->testPasswordReset1 = factory(PasswordReset::class)->create([
//            'email' => $this->testUser->email,
//            'created_at' => date('Y-m-d h:m:s', time()-3601)
//        ]);
//        $this->testPasswordReset1->save();
//        // Test data with exist email and token
//        $data = array_merge($this->makeTestData(), [
//            'email' => $this->testPasswordReset1->email,
//            'token' => $this->testPasswordReset1->token,
//        ]);
//
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, 'E0016');
//    }
//
//    public function testUnExistEmailInPasswordResetDBCase()
//    {
//        // make PasswordReset have email not exist
//        $this->testPasswordReset = factory(PasswordReset::class)->create([
//            'email' => 'mail_unexist@gmail.com',
//        ]);
//        $this->testPasswordReset->save();
//        // Test data with existed email in User and exist token
//        $data = array_merge($this->makeTestData(), [
//            'email' => $this->testUser->email,
//            'token' => $this->testPasswordReset->token,
//        ]);
//
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, 'E0016');
//    }

//    /**
//     * @param array $data
//     * @param string $errorCode
//     * @dataProvider missingFieldDataProvider
//     */
//    public function testMissingFieldCase($data, $errorCode)
//    {
//        // check event isn't fired
//        $this->doesntExpectEvents(PasswordWasReset::class);
//
//        // Call API
//        $response = $this->callApi($data);
//
//        // Check response
//        $this->assertResponseError($response, $errorCode);
//    }
//
//    public function missingFieldDataProvider()
//    {
//        $email = 'a123456789012345678901234567890';
//        while(strlen($email) < 200) {
//            $email = $email.$email;
//        }
//        return [
//            [ // Case missing email
//                array_except($this->makeTestData(), ['email']),
//                'E0007',
//            ],
//            [ // Case missing password
//                array_except($this->makeTestData(), ['password']),
//                'E0010',
//            ],
//            [ // Case missing token
//                array_except($this->makeTestData(), ['token']),
//                'E0003',
//            ],
//            [ // Case missing email and password
//                array_except($this->makeTestData(), ['email', 'password']),
//                'E0007',
//            ],
//            [ // Case missing email and token
//                array_except($this->makeTestData(), ['email', 'token']),
//                'E0007',
//            ],
//            [ // Case missing token and password
//                array_except($this->makeTestData(), ['token', 'password']),
//                'E0010',
//            ],
//            [ // Case missing email, token and password
//                array_except($this->makeTestData(), ['email', 'token', 'password']),
//                'E0007',
//            ],
//            [ // Case email is empty
//                array_merge($this->makeTestData(), ['email' => '']),
//                'E0007',
//            ],
//            [ // Case token is empty
//                array_merge($this->makeTestData(), ['token' => '']),
//                'E0003',
//            ],
//            [ // Case password is empty
//                array_merge($this->makeTestData(), ['password' => '']),
//                'E0010',
//            ],
//            [ // Case empty email and password
//                array_except($this->makeTestData(), ['email' => '', 'password' => '']),
//                'E0009',
//            ],
//            [ // Case empty email and token
//                array_except($this->makeTestData(), ['email' => '', 'token' => '']),
//                'E0009',
//            ],
//            [ // Case empty token and password
//                array_except($this->makeTestData(), ['token' => '', 'password' => '']),
//                'E0009',
//            ],
//            [ // Case empty email, token and password
//                array_except($this->makeTestData(), ['email' => '', 'token' => '', 'password' => '']),
//                'E0009',
//            ],
//            [ // Case invalid email 
//                array_merge($this->makeTestData(), ['email' => 'mr.tester@']),
//                'E0007',
//            ],
//            [ // Case invalid email 
//                array_merge($this->makeTestData(), ['email' => 'mr.tester@example']),
//                'E0007',
//            ],
//            [ // Case invalid email 
//                array_merge($this->makeTestData(), ['email' => 'mr.tester@example.']),
//                'E0007',
//            ],
//            [ // Case invalid email 
//                array_merge($this->makeTestData(), ['email' => $email.'@gmail.com']),
//                'E0007'
//            ],
//            [ // Case invalid email 
//                array_merge($this->makeTestData(), ['email' => $email.'@gmail.com']),
//                'E0007'
//            ],
//            [ // Case password is so short
//                array_merge($this->makeTestData(), ['password' => '12345']),
//                'E0010'
//            ],
//            [ // Case password is so long
//                array_merge($this->makeTestData(), ['password' => '123456789012345678901']),
//                'E0010'
//            ],
//        ];
//    }
}
