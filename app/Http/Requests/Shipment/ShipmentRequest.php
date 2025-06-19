<?php

namespace App\Http\Requests\Shipment;

use App\Enums\ShipmentStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ShipmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'string|nullable',
            'status' => [
                'nullable',
                new Enum(ShipmentStatus::class)
            ],
            'per_page' => 'integer|nullable',
            'weight' => 'integer|nullable',
            'tracking_number' => 'string|nullable',
        ];
    }
}
