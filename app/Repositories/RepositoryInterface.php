<?php

namespace App\Repositories;

use App\DTO\IndexResponseDTO;
use App\Http\IndexParams;
use Illuminate\Database\Eloquent\Builder;

interface RepositoryInterface
{
    public function index(IndexParams $params): IndexResponseDTO;

    public function getTotal(Builder $builder): int;

    public function applyRange(IndexParams $params): Builder;
}
