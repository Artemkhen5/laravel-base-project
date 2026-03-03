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
        $this->applyRange($params);
        $this->applySort($params);
        return new IndexResponseDTO($total, $this->builder->get());
    }

    public function getTotal(Builder $builder): int
    {
        return $this->builder->count();
    }

    public function applyRange(IndexParams $params): void
    {
        $this->builder->offset($params->getOffset())->limit($params->getLimit());
    }

    public function applySort(IndexParams $params): void
    {
        if (!is_null($params->getSort())) {
            $column = $params->getSort()[0];
            $dir = $params->getSort()[1];
            $this->builder->orderBy($column, $dir);
        }
    }
}
