<?php

namespace App\Dtos\Shipments;

use App\Dtos\BaseDTO;
use App\Enums\ShipmentStatus;
use App\ValueObjects\Dimensions;

class ShipmentDTO extends BaseDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $customer_name,
        public string $address,
        public string $country,
        public float $weight,
        public Dimensions $dimensions,
        public string $shipping_company,
        public string $tracking_number,
        public ?ShipmentStatus $status = null
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            customer_name: $data['customer_name'] ?? '',
            address: $data['address'] ?? '',
            country: $data['country'] ?? '',
            weight: $data['weight'] ?? 0,
            dimensions: new Dimensions(width: $data['dimensions']['width'] ?? 0, length: $data['dimensions']['length'] ?? 0, height: $data['dimensions']['height'] ?? 0),
            shipping_company: $data['shipping_company'] ?? '',
            tracking_number: $data['tracking_number'] ?? '',
            status: $data['status'] ?? ShipmentStatus::PENDING
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'customer_name' => $this->customer_name,
            'address' => $this->address,
            'country' => $this->country,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'shipping_company' => $this->shipping_company,
            'tracking_number' => $this->tracking_number,
            'status' => $this->status,
        ];
    }
}
