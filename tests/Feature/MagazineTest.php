<?php

namespace Tests\Feature;

use Tests\FeatureTrait\Authorization;
use Tests\TestCase;

class MagazineTest extends TestCase
{
    use Authorization;

    const MAGAZINE_URL = '/api/magazines/%s';

    public function test_Get_Should_ResponseWithStatusCode401_When_UserIsNotAuthenticated()
    {
        $response = $this->get(sprintf(self::MAGAZINE_URL, '1'));
        $response->assertStatus(401);
    }

    public function test_Get_Should_ResponseWithStatusCode200AndItem_When_UserIsAuthenticated()
    {
        $headers = $this->getAuthHeaders();
        $response = $this->get(sprintf(self::MAGAZINE_URL, 1), $headers);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'id',
                'name',
                'publisher_id',
                'created_at',
                'updated_at',
            ]
        );
    }

    public function test_Get_Should_ResponseWithStatusCode404_When_MagazineNotFound()
    {
        $headers = $this->getAuthHeaders();
        $response = $this->get(sprintf(self::MAGAZINE_URL, 0), $headers);
        $response->assertStatus(404);
    }

    public function test_PostSearch_Should_ResponseWithStatusCode200AndItems_When_UserIsAuthenticated()
    {
        $headers = $this->getAuthHeaders();
        $response = $this->post(sprintf(self::MAGAZINE_URL, 'search'), [], $headers);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'publisher_id',
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
        ]);
    }

    public function test_PostSearch_Should_ResponseWithStatusCode200AndItems_When_SearchByExistingPublisher()
    {
        $headers = $this->getAuthHeaders();

        $response = $this->postJson(sprintf(self::MAGAZINE_URL, 'search'), [
            'publisherId' => 1,
        ], $headers);

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }

    public function test_PostSearch_Should_ResponseWithStatusCode200AndItems_When_SearchByExistingName()
    {
        $headers = $this->getAuthHeaders();

        $response = $this->postJson(sprintf(self::MAGAZINE_URL, 'search'), [
            'name' => 'agazin',
        ], $headers);

        $response->assertStatus(200);
        $response->assertJsonCount(15, 'data');
        $meta = $response->json('meta');
        $this->assertEquals(30, $meta['total']);
    }

    public function test_PostSearch_Should_ResponseWithStatusCode200AndItems_When_SearchByExistingPublisherAndName()
    {
        $headers = $this->getAuthHeaders();

        $response = $this->postJson(sprintf(self::MAGAZINE_URL, 'search'), [
            'publisherId' => 3,
            'name' => 'agazin',
        ], $headers);

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
