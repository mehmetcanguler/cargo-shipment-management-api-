<?php

namespace App\Dtos\Shipments;

use App\Dtos\FilterDTO;
use App\Enums\ShipmentStatus;

class ShipmentFilterDTO extends FilterDTO
{
    /**
     * Create a new class instance.
     * Shipment Model fillable data
     */
    public function __construct(
        public ?string $search = null,
        public ?ShipmentStatus $status = null,
        public int $per_page = 10,
        public ?int $weight = null,
        public ?string $tracking_number = null
    ) {
        if ($this->search) {
            $this->search = $this->searchStrReplace($this->search);
        }
    }

    /**
     * {@inheritDoc}
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            search: $data['search'] ?? null,
            status: isset($data['status']) ? ShipmentStatus::from($data['status']) : null,
            per_page: $data['per_page'] ?? 10,
            weight: $data['weight'] ?? null,
            tracking_number: $data['tracking_number'] ?? null
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'search' => $this->search,
            'status' => $this->status,
            'per_page' => $this->per_page,
            'weight' => $this->weight,
            'tracking_number' => $this->tracking_number,
        ];
    }
}
