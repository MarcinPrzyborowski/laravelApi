<?php

declare(strict_types=1);

namespace Tests\FeatureTrait;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
trait Authorization
{
    public function getAuthHeaders()
    {
        $response = $this->post('/api/login',
            ['email' => \DatabaseSeeder::TEST_EMAIL, 'password' => \DatabaseSeeder::TEST_PASSWORD]);

        $content = json_decode($response->getContent(), true);

        return [
            'Authorization' => $content['token_type'].' '.$content['access_token'],
        ];
    }
}
