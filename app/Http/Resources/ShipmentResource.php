<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'address' => $this->address,
            'country' => $this->country,
            'weight' => $this->weight,
            'dimensions' => $this->dimensions,
            'shipping_company' => $this->shipping_company,
            'tracking_number' => $this->tracking_number,
            'status' => EnumResource::make($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
