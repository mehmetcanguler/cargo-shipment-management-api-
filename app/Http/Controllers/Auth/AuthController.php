<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Dtos\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Support\Helpers\ApiResponse;

class AuthController extends Controller
{
    public function __construct(private readonly AuthServiceInterface $authService) {}

    public function login(LoginRequest $request)
    {
        $dto = LoginDTO::fromRequest($request->validated());

        $result = $this->authService->login($dto);

        return ApiResponse::item([
            'user' => UserResource::make($result['user']),
            'token' => $result['token'],
        ]);
    }

    public function logout()
    {
        $userId = auth()->user()->id;
        $this->authService->logout($userId);

        return ApiResponse::success();
    }
}
