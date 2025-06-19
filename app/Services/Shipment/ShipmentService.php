<?php

namespace App\Services\Shipment;

use App\Contracts\Repositories\Shipment\ShipmentReadRepositoryInterface;
use App\Contracts\Repositories\Shipment\ShipmentWriteRepositoryInterface;
use App\Contracts\Services\Shipment\ShipmentServiceInterface;
use App\Dtos\FilterDTO;
use App\Dtos\Shipments\ShipmentFilterDTO;
use App\Services\BaseService;
use App\ValueObjects\Dimensions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ShipmentService extends BaseService implements ShipmentServiceInterface
{

    public function __construct(
        ShipmentReadRepositoryInterface $readRepository,
        ShipmentWriteRepositoryInterface $writeRepository
    ) {
        parent::__construct(
            $readRepository,
            $writeRepository
        );
    }

    /**
     * @param ShipmentFilterDTO $filter
     */
    public function getAll(FilterDTO|ShipmentFilterDTO $filterDTO): LengthAwarePaginator
    {
        return $this->readRepository->paginate(function (Builder $query) use ($filterDTO) {
            if ($filterDTO->search) {
                $query->where(function (Builder $query) use ($filterDTO) {
                    $query->where('customer_name', 'like', '%' . $filterDTO->search . '%')
                        ->orWhere('address', 'like', '%' . $filterDTO->search . '%')
                        ->orWhere('country', 'like', '%' . $filterDTO->search . '%')
                        ->orWhere('tracking_number', 'like', '%' . $filterDTO->search . '%')
                        ->orWhere('shipping_company', 'like', '%' . $filterDTO->search . '%');
                });
            }
            if ($filterDTO->status) {
                $query->where('status', $filterDTO->status);
            }
            if ($filterDTO->weight) {
                $query->where('weight', $filterDTO->weight);
            }

            if ($filterDTO->trackingNumber) {
                $query->where('tracking_number', $filterDTO->trackingNumber);
            }
            $query->orderBy('created_at', 'desc');
        }, $filterDTO->perPage);
    }

    public function shippingPriceCalculation(Dimensions $dimensions) : Dimensions
    {
        return $dimensions;
    }
}
