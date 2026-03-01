<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

final class IndexResponseDTO
{
    public function __construct(private int $total, private Collection $collection) {}

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }
}
