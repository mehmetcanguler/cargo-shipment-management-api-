<?php

namespace App\Http\Requests\Shipment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ShipmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'weight' => 'required|numeric',
            'dimensions' => 'required|array',
            'dimensions.length' => 'required|numeric',
            'dimensions.width' => 'required|numeric',
            'dimensions.height' => 'required|numeric',
            'shipping_company' => 'required|string',
            'tracking_number' => 'required|string:unique:shipments,tracking_number',
        ];
    }
}
