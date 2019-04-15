<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Magazine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class Magazines
{
    public function search(Request $request)
    {
        return $request->getContent();
    }


    public function get($id)
    {
        $magazine = Magazine::find($id);
        return $magazine ?? response('', Response::HTTP_NOT_FOUND);
    }
}
