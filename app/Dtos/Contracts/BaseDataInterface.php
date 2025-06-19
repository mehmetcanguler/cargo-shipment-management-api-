<?php

namespace App\Dtos\Contracts;

interface BaseDataInterface
{
    public static function fromRequest(array $data): static;

    public function toArray(): array;
}
