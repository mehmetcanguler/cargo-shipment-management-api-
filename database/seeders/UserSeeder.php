<?php

namespace Database\Seeders;

use App\Contracts\Services\User\UserServiceInterface;
use App\Dtos\User\UserDTO;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userService = app(UserServiceInterface::class);
        $userService->create(UserDTO::fromRequest([
            'name' => 'Admin',
            'email' => 'admin@cargoshipmanagement.com',
            'password' => 'password',
        ]));
    }
}
