<?php

namespace App\Repositories;

use App\DTO\IndexResponseDTO;
use App\Http\IndexParams;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements RepositoryInterface
{
    protected string|Model $model;

    public function __construct(protected Builder $builder)
    {
        $this->builder = $this->model::query();
    }

    public function index(IndexParams $params): IndexResponseDTO
    {
        $total = $this->builder->count();
        $builder = $this->applyRange($params);
        return new IndexResponseDTO($total, $builder->get());
    }

    public function getTotal(Builder $builder): int
    {
        return $this->builder->count();
    }

    public function applyRange(IndexParams $params): Builder
    {
        return $this->builder->offset($params->getOffset())->limit($params->getLimit());
    }
}
