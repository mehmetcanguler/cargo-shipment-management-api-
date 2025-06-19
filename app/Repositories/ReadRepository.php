<?php

namespace App\Repositories;

use App\Contracts\Repositories\ReadRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class ReadRepository implements ReadRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->model->all();
    }

    public function find(int|string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findWhere(array|callable $conditions): ?Model
    {
        $query = $this->model->newQuery();

        if (is_array($conditions)) {
            $query->where($conditions);
        } elseif (is_callable($conditions)) {
            $conditions($query);
        }

        return $query->first();
    }

    public function paginate(?callable $callback = null, int $per_page = 10): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if ($callback) {
            $callback($query);
        }

        return $query->paginate($per_page);
    }

    public function query(?callable $callback = null): \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->model->newQuery();

        if ($callback) {
            $callback($query);
        }

        return $query;
    }
}
