<?php

namespace App\Contracts\Services;

use App\Dtos\BaseDTO;
use App\Dtos\FilterDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ServiceInterface
{
    public function getAll(FilterDTO $filterDTO): LengthAwarePaginator;

    public function getById(int $id): ?Model;

    public function create(BaseDTO $data): Model;

    public function update(int $id, BaseDTO $data): ?Model;

    public function delete(int $id): bool;
}
