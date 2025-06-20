<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReadRepositoryInterface
{
    public function all(): Collection;

    public function query(?callable $callback = null): Builder;

    public function paginate(?callable $callback = null, int $per_page = 10): LengthAwarePaginator;

    public function findWhere(array|callable $conditions): ?Model;

    public function find(int $id): ?Model;
}
