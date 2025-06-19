<?php

namespace App\Contracts\Services\Auth;

use App\Dtos\Auth\LoginDTO;

interface AuthServiceInterface
{
    public function login(LoginDTO $dto): array;

    public function logout(int $userId): bool;
}
