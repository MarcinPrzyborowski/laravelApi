<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Middleware\RequestJson;
use App\Magazine;
use App\Models\Magazine\DTO\SearchDTO;
use App\Models\Magazine\Searcher;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class Magazines
{
    /**
     * @var Searcher
     */
    private $searcher;

    public function __construct(Searcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function search(Request $request)
    {
        $searchDTO = new SearchDTO($request->get(RequestJson::REQUEST_JSON));

        return new ResourceCollection($this->searcher->paginate($searchDTO));
    }

    public function get($id)
    {
        $magazine = Magazine::find($id);

        return $magazine ?? response('', Response::HTTP_NOT_FOUND);
    }
}
