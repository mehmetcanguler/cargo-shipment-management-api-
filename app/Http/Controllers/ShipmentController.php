<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Shipment\ShipmentServiceInterface;
use App\Dtos\Shipments\ShipmentDTO;
use App\Dtos\Shipments\ShipmentFilterDTO;
use App\Http\Requests\Shipment\ShipmentRequest;
use App\Http\Requests\Shipment\ShipmentStoreRequest;
use App\Http\Requests\Shipment\ShipmentUpdateRequest;
use App\Http\Requests\Shipment\ShippingPriceCalculationRequest;
use App\Http\Resources\ShipmentResource;
use App\Support\Helpers\ApiResponse;
use App\ValueObjects\Dimensions;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function __construct(
        private ShipmentServiceInterface $shipmentService
    ) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(ShipmentRequest $request)
    {
        return ApiResponse::collection(
            collection: ShipmentResource::collection(
                resource: $this->shipmentService->getAll(
                    filterDTO: ShipmentFilterDTO::fromRequest(
                        data: $request->validated()
                    )
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShipmentStoreRequest $request)
    {
        $this->shipmentService->create(
            data: ShipmentDTO::fromRequest(
                data: $request->validated()
            )
        );

        return ApiResponse::created();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ApiResponse::item(
            data: ShipmentResource::make(
                $this->shipmentService->getById(id: $id)
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShipmentUpdateRequest $request, string $id)
    {
        $this->shipmentService->update(
            id: $id,
            data: ShipmentDTO::fromRequest(
                data: $request->validated()
            )
        );

        return ApiResponse::updated();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->shipmentService->delete(id: $id);

        return ApiResponse::deleted();
    }

    public function shippingPriceCalculation(ShippingPriceCalculationRequest $request)
    {
        return ApiResponse::item(
            data: $this->shipmentService->shippingPriceCalculation(
                Dimensions::fromRequest($request->validated()['dimensions'])
            )
        );
    }
}
