<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Middleware\RequestJson;
use App\Models\Magazine;
use App\Repository\Magazine\MagazineRepository;
use App\Repository\Magazine\SearchDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\ResponseFactory;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class MagazineController
{
    /**
     * @var MagazineRepository
     */
    private $magazineRepository;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    public function __construct(MagazineRepository $magazineRepository, ResponseFactory $responseFactory)
    {
        $this->magazineRepository = $magazineRepository;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @param Request $request
     * @return ResourceCollection
     */
    public function search(Request $request)
    {
        $searchDTO = new SearchDTO($request->get(RequestJson::REQUEST_JSON));
        $result = $this->magazineRepository->paginateBySearchDTO($searchDTO);

        return new ResourceCollection($result);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\Response|Magazine
     */
    public function get(int $id)
    {
        $magazine = $this->magazineRepository->findOne($id);

        return $magazine ?? $this->responseFactory->make('', 404);
    }
}
