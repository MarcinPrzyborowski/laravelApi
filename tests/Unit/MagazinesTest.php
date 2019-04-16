<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\MagazineController;
use App\Http\Middleware\RequestJson;
use App\Models\Magazine;
use App\Repository\Magazine\MagazineRepository;
use App\Repository\Magazine\SearchDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\ResponseFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

class MagazinesTest extends TestCase
{
    /**
     * @var Request|ObjectProphecy
     */
    private $request;

    /**
     * @var MagazineRepository|ObjectProphecy
     */
    private $magazineRepository;
    /**
     * @var ResponseFactory|ObjectProphecy
     */
    private $responseFactory;
    /**
     * @var LengthAwarePaginator
     */
    private $paginator;
    /**
     * @var MagazineController
     */
    private $controller;

    public function setUp()
    {
        $this->request = $this->prophesize(Request::class);
        $this->magazineRepository = $this->prophesize(MagazineRepository::class);
        $this->responseFactory = $this->prophesize(ResponseFactory::class);
        $this->paginator = new LengthAwarePaginator([], 0, 1);
        $this->controller = new MagazineController($this->magazineRepository->reveal(), $this->responseFactory->reveal());
    }

    public function test_get_Should_ReturnModel_When_FindOneReturnModel()
    {
        $model = new Magazine();
        $this->magazineRepository->findOne(1)->willReturn($model)->shouldBeCalledTimes(1);
        $result = $this->controller->get(1);
        $this->assertEquals($model, $result);
    }

    public function test_get_Should_ReturnResponseWithStatusCode404_When_FindOneReturnNull()
    {
        $model = null;
        $this->magazineRepository->findOne(1)->willReturn($model)->shouldBeCalledTimes(1);

        $response = new Response('', 404);
        $this->responseFactory->make('', 404)->willReturn($response)->shouldBeCalledTimes(1);

        $result = $this->controller->get(1);

        $this->assertEquals(404, $result->getStatusCode());
    }

    public function test_search_Should_ReturnResourceCollection()
    {
        $data = [];
        $this->request->get(RequestJson::REQUEST_JSON)->willReturn($data)->shouldBeCalledTimes(1);
        $searchDTO = new SearchDTO($data);
        $this->magazineRepository->paginateBySearchDTO($searchDTO)->willReturn($this->paginator)->shouldBeCalledTimes(1);

        $expected = new ResourceCollection($this->paginator);
        $result = $this->controller->search($this->request->reveal());

        $this->assertEquals($expected, $result);
    }
}
