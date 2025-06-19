<?php

namespace App\Repositories;

use App\Contracts\Repositories\WriteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class WriteRepository implements WriteRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function add(array $data): Model
    {
        return $this->model::create($data);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }
}
