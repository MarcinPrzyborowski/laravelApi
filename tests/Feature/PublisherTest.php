<?php

namespace Tests\Feature;

use Tests\FeatureTrait\Authorization;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    use Authorization;

    const PUBLISHER_URL = '/api/publishers';

    public function test_Get_Should_ResponseWithStatusCode401_When_UserIsNotAuthenticated()
    {
        $response = $this->get(sprintf(self::PUBLISHER_URL, '1'));
        $response->assertStatus(401);
    }

    public function test_Get_Should_ResponseWithStatusCode200AndItem_When_UserIsAuthenticated()
    {
        $headers = $this->getAuthHeaders();
        $response = $this->get(sprintf(self::PUBLISHER_URL, 1), $headers);

        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]
        );

        $meta = $response->json('meta');
        $this->assertEquals(3, $meta['total']);
    }
}
