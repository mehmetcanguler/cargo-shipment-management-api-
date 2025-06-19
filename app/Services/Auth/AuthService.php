<?php

namespace App\Services\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\Repositories\User\UserReadRepositoryInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Dtos\Auth\LoginDTO;
use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function __construct(protected UserReadRepositoryInterface $userReadRepository)
    {
    }

    public function login(LoginDTO $dto): array
    {
        $user = $this->userReadRepository->findWhere(fn ($q) => $q->where('email', $dto->email));

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw new BadRequestException(trans('auth.invalid_user_credentials'));
        }

        return [
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];
    }

    public function logout(int $userId): bool
    {
        $user = $this->userReadRepository->find($userId);

        if (!$user instanceof Model) {
            return false;
        }

        $user->tokens()->delete();

        return true;
    }
}
