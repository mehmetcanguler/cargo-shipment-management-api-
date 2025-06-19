<?php

namespace App\Repositories;

use App\Contracts\Repositories\WriteRepositoryInterface;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

abstract class WriteRepository implements WriteRepositoryInterface
{
    protected Model $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
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
