<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\PublisherController;
use App\Repository\Publisher\PublisherRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class PublishersTest extends TestCase
{
    /**
     * @var PublisherRepository|ObjectProphecy
     */
    private $publisherRepository;

    /**
     * @var LengthAwarePaginator
     */
    private $paginator;
    /**
     * @var PublisherController
     */
    private $controller;

    public function setUp()
    {
        $this->publisherRepository = $this->prophesize(PublisherRepository::class);
        $this->paginator = new LengthAwarePaginator([], 0, 1);
        $this->controller = new PublisherController($this->publisherRepository->reveal());
    }

    public function test_getAll_Should_CallPaginateOnceAndReturnResourceCollection()
    {
        $this->publisherRepository->paginate()->willReturn($this->paginator)->shouldBeCalledTimes(1);

        $expected = new ResourceCollection($this->paginator);
        $result = $this->controller->getAll();

        $this->assertEquals($expected, $result);
    }
}
