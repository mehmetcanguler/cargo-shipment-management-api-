<?php

namespace App\Contracts\Services\Shipment;

use App\Contracts\Services\ServiceInterface;
use App\ValueObjects\Dimensions;

interface ShipmentServiceInterface extends ServiceInterface
{
    public function shippingPriceCalculation(Dimensions $dimensions): Dimensions;
}
