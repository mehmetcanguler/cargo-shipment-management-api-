<?php

namespace App\Services;
use App\Contracts\Repositories\ReadRepositoryInterface;
use App\Contracts\Repositories\WriteRepositoryInterface;
use App\Contracts\Services\ServiceInterface;
use App\Dtos\BaseDTO;
use App\Dtos\FilterDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseService implements ServiceInterface
{
    protected ReadRepositoryInterface $readRepository;
    protected WriteRepositoryInterface $writeRepository;

    public function __construct(
        ReadRepositoryInterface $readRepository,
        WriteRepositoryInterface $writeRepository
    ) {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
    }

    public function getAll(FilterDTO $filterDTO): LengthAwarePaginator
    {
        return $this->readRepository->paginate(function ($query) {
            $query->orderBy('created_at', 'desc');
        }, $filterDTO->perPage);
    }

    public function getById(int|string $id): ?Model
    {
        $model = $this->readRepository->find($id);
        if (!$model) {
            throw new ModelNotFoundException('Model not found');
        }
        return $model;
    }

    public function create(BaseDTO $data): Model
    {
        return $this->writeRepository->add($data->toArray());
    }

    public function update(int|string $id, BaseDTO $data): ?Model
    {
        $model = $this->getById($id);

        if (!$model) {
            return null;
        }

        return $this->writeRepository->update($model, $data->toArray());
    }

    public function delete(int|string $id): bool
    {
        $model = $this->getById($id);

        if (!$model) {
            return false;
        }

        return $this->writeRepository->delete($model);
    }
}
