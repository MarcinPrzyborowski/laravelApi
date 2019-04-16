<?php

declare(strict_types=1);

namespace App\Repository\Magazine;

use App\Models\Magazine;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class MagazineRepository
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOne(int $id)
    {
        return Magazine::find($id);
    }

    /**
     * @param SearchDTO $searchDTO
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateBySearchDTO(SearchDTO $searchDTO)
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
