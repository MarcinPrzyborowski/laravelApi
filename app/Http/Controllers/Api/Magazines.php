<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Middleware\RequestJson;
use App\Repository\Magazine\MagazineRepository;
use App\Repository\Magazine\SearchDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class Magazines
{
    /**
     * @var MagazineRepository
     */
    private $magazineRepository;

    public function __construct(MagazineRepository $magazineRepository)
    {
        $this->magazineRepository = $magazineRepository;
    }

    public function search(Request $request)
    {
        $searchDTO = new SearchDTO($request->get(RequestJson::REQUEST_JSON));
        $result = $this->magazineRepository->paginateBySearchDTO($searchDTO);

        return new ResourceCollection($result);
    }

    public function get(int $id)
    {
        $magazine = $this->magazineRepository->findOne($id);

        return $magazine ?? response('', Response::HTTP_NOT_FOUND);
    }
}
