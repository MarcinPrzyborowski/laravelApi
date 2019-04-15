<?php

declare(strict_types=1);

namespace App\Repository\Publisher;

use App\Publisher;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class PublisherRepository
{
    public function paginate()
    {
        return Publisher::paginate();
    }
}
