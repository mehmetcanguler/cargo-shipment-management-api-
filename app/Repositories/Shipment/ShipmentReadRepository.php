<?php

namespace App\Repositories\Shipment;

use App\Contracts\Repositories\Shipment\ShipmentReadRepositoryInterface;
use App\Models\Shipment;
use App\Repositories\ReadRepository;

class ShipmentReadRepository extends ReadRepository implements ShipmentReadRepositoryInterface
{
    public function __construct(Shipment $shipment)
    {
        parent::__construct(model: $shipment);
    }
}
