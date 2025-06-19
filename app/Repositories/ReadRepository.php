<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Contracts\Repositories\ReadRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class ReadRepository implements ReadRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function all(): Collection
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

    public function paginate(?callable $callback = null, int $per_page = 10): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if ($callback !== null) {
            $callback($query);
        }

        return $query->paginate($per_page);
    }

    public function query(?callable $callback = null): Builder
    {
        $query = $this->model->newQuery();

        if ($callback !== null) {
            $callback($query);
        }

        return $query;
    }
}
