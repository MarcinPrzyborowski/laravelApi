<?php

declare(strict_types=1);

namespace App\Models\Magazine\DTO;

/**
 * @author Marcin Przyborowski <hiprzyborowski@gmail.com>
 */
class SearchDTO
{
    public $publisherId;
    public $name;

    public function __construct(array $input)
    {
        foreach ($input as $property => $value) {
            $this->$property = $value;
        }
    }
}
