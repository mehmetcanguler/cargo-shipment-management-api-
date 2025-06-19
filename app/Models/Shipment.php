<?php

namespace App\Models;

use App\Casts\DimensionsCast;
use App\Enums\ShipmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'address',
        'country',
        'weight',
        'dimensions',
        'shipping_company',
        'tracking_number',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'customer_name' => 'string',
            'address' => 'string',
            'country' => 'string',
            'weight' => 'float',
            'dimensions' => DimensionsCast::class,
            'shipping_company' => 'string',
            'tracking_number' => 'string',
            'status' => ShipmentStatus::class
        ];
    }

    protected $attributes = [
        'status' => ShipmentStatus::PENDING
    ];
}
