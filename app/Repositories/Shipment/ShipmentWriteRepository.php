<?php

namespace App\Repositories\Shipment;

use App\Contracts\Repositories\Shipment\ShipmentWriteRepositoryInterface;
use App\Models\Shipment;
use App\Repositories\WriteRepository;

class ShipmentWriteRepository extends WriteRepository implements ShipmentWriteRepositoryInterface
{
    public function __construct(Shipment $shipment)
    {
        parent::__construct(model: $shipment);
    }
}
