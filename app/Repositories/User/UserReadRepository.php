<?php

namespace App\Repositories\User;

use App\Contracts\Repositories\User\UserReadRepositoryInterface;
use App\Models\User;
use App\Repositories\ReadRepository;

/**
 * @extends ReadRepository<User>
 */
class UserReadRepository extends ReadRepository implements UserReadRepositoryInterface
{
    
    public function __construct(User $user)
    {
        parent::__construct(model: $user);
    }
}
