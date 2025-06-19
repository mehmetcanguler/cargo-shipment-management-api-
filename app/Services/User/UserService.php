<?php

namespace App\Services\User;

use App\Contracts\Repositories\User\UserReadRepositoryInterface;
use App\Contracts\Repositories\User\UserWriteRepositoryInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Services\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public function __construct(
        UserReadRepositoryInterface $readRepository,
        UserWriteRepositoryInterface $writeRepository
    ) {
        parent::__construct($readRepository, $writeRepository);
    }

}
