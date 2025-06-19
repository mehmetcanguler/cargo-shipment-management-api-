<?php

namespace App\Dtos\Auth;

use App\Dtos\BaseDTO;
use App\Dtos\FilterDTO;

class LoginDTO extends FilterDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromRequest(array $data): static
    {
        return new self(
            email: $data['email'] ?? '',
            password: $data['password'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
