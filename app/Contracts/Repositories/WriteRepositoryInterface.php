<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface WriteRepositoryInterface 
{
    public function add(array $data): Model;

    public function update(Model $model, array $data): Model;

    public function delete(Model $model): bool;
}
