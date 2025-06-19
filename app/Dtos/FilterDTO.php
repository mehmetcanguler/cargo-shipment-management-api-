<?php

namespace App\Dtos;

class FilterDTO extends BaseDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $perPage = 10
    ) {
        //
    }

    /**
     * @inheritDoc
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            perPage: $data['perPage'] ?? 10
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'perPage' => $this->perPage,
        ];
    }
}
