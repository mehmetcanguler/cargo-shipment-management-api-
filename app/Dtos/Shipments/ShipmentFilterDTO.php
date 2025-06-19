<?php

namespace App\Dtos\Shipments;

use App\Dtos\BaseDTO;
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
        public int $perPage = 10,
        public ?int $weight = null,
        public ?string $trackingNumber = null
    ) {
        //
    }

    /**
     * @inheritDoc
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            search: $data['search'] ?? null,
            status: isset($data['status']) ? ShipmentStatus::from($data['status']) : null,
            perPage: $data['per_page'] ?? 10,
            weight: $data['weight'] ?? null,
            trackingNumber: $data['tracking_number'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'search' => $this->search,
            'status' => $this->status,
            'perPage' => $this->perPage,
            'weight' => $this->weight,
            'trackingNumber' => $this->trackingNumber,
        ];
    }
}
