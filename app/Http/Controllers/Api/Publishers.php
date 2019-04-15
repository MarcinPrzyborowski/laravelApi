<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Publisher;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class Publishers
{
    public function getAll()
    {
        return new ResourceCollection(Publisher::paginate());
    }
}
