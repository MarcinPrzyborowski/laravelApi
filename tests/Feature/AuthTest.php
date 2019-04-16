<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    const LOGIN_URL = '/api/login';

    /**
     * @dataProvider credentialsDataProvider
     *
     * @param $credentials
     */
    public function testAuthInvalidCredentials($credentials)
    {
        $response = $this->post(self::LOGIN_URL, $credentials);
        $response->assertStatus(401);
    }

    public function credentialsDataProvider()
    {
        return [
            'empty' => [[]],
            'invalidProperties' => [['name' => 'test1']],
            'invalidCredentials' => [['email' => 'test1', 'password' => 'test1']],
        ];
    }

    public function testAuthValidCredentials()
    {
        $response = $this->post(self::LOGIN_URL,
            ['email' => \DatabaseSeeder::TEST_EMAIL, 'password' => \DatabaseSeeder::TEST_PASSWORD]);
        $response->assertStatus(200);
    }
}
