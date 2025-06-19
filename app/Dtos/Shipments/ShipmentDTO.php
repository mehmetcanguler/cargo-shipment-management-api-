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
        public string $customerName,
        public string $address,
        public string $country,
        public float $weight,
        public Dimensions $dimensions,
        public string $shippingCompany,
        public string $trackingNumber,
        public ?ShipmentStatus $status = null
    ) {
        //
    }

    /**
     * @inheritDoc
     */
    public static function fromRequest(array $data): static
    {
        return new self(
            customerName: $data['customer_name'] ?? '',
            address: $data['address'] ?? '',
            country: $data['country'] ?? '',
            weight: $data['weight'] ?? 0,
            dimensions: new Dimensions(width: $data['dimensions']['width'] ?? 0, length: $data['dimensions']['length'] ?? 0, height: $data['dimensions']['height'] ?? 0),
            shippingCompany: $data['shipping_company'] ?? '',
            trackingNumber: $data['tracking_number'] ?? '',
            status: $data['status']
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'customer_name' => $this->customerName,
            'address' => $this->address,
            'country' => $this->country,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'shipping_company' => $this->shippingCompany,
            'tracking_number' => $this->trackingNumber,
            'status' => $this->status
        ];
    }
}
