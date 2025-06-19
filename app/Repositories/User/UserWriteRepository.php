<?php

namespace App\Repositories\User;

use App\Contracts\Repositories\User\UserWriteRepositoryInterface;
use App\Models\User;
use App\Repositories\WriteRepository;

/**
 * @extends WriteRepository<User>
 */
class UserWriteRepository extends WriteRepository implements UserWriteRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct(model: $user);
    }
}
