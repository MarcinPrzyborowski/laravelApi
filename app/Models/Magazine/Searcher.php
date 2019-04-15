<?php

declare(strict_types=1);

namespace App\Models\Magazine;

use App\Magazine;
use App\Models\Magazine\DTO\SearchDTO;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class Searcher
{
    public function paginate(SearchDTO $searchDTO): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Magazine::query();
        if ($searchDTO->name) {
            $query->where('name', 'like', '%'.$searchDTO->name.'%');
        }

        if ($searchDTO->publisherId) {
            $query->where('publisher_id', '=', $searchDTO->publisherId);
        }

        return $query->paginate();
    }
}
