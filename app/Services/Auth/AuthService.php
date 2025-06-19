<?php

namespace App\Services\Auth;

use App\Contracts\Repositories\User\UserReadRepositoryInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Dtos\Auth\LoginDTO;
use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService implements AuthServiceInterface
{
    protected UserReadRepositoryInterface $userReadRepository;

    public function __construct(UserReadRepositoryInterface $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
    }

    public function login(LoginDTO $dto): array
    {
        $user = $this->userReadRepository->findWhere(fn($q) => $q->where('email', $dto->email));

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new BadRequestException('Geçersiz kullanıcı bilgileri.');
        }

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ];
    }

    public function logout(int $userId): bool
    {
        $user = $this->userReadRepository->find($userId);

        if (!$user) {
            return false;
        }

        $user->tokens()->delete();
        return true;
    }
}
