<?php

namespace App\Dtos;

class FilterDTO extends BaseDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $per_page = 10
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            per_page: $data['per_page'] ?? 10
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'per_page' => $this->per_page,
        ];
    }

    protected function searchStrReplace(string $search): string
    {
        $search = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);

        return $search;
    }
}
