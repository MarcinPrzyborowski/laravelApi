<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Repository\Publisher\PublisherRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class PublisherController
{
    /**
     * @var PublisherRepository
     */
    private $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * @return ResourceCollection
     */
    public function getAll()
    {
        return new ResourceCollection($this->publisherRepository->paginate());
    }
}
