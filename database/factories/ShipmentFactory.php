<?php

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use App\ValueObjects\Dimensions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'dimensions' => [
                'width' => $this->faker->randomFloat(2, 1, 100),
                'length' => $this->faker->randomFloat(2, 1, 100),
                'height' => $this->faker->randomFloat(2, 1, 100),
            ],
            'shipping_company' => $this->faker->company(),
            'tracking_number' => $this->faker->bothify('TR#####'),
        ];
    }
}
