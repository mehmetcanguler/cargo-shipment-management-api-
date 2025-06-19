<?php

namespace App\Casts;

use App\ValueObjects\Dimensions;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DimensionsCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new Dimensions(...json_decode($value, true));
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (is_array($value)) {
            return [
                $key => json_encode([
                    'width' => $value['width'] ?? 0,
                    'height' => $value['height'] ?? 0,
                    'length' => $value['length'] ?? 0,
                ]),
            ];
        }

        if ($value instanceof Dimensions) {
            return [
                $key => json_encode([
                    'width' => $value->width,
                    'height' => $value->height,
                    'length' => $value->length,
                ]),
            ];
        }

        return [
            $key => json_encode([
                'width' => 0,
                'height' => 0,
                'length' => 0,
            ]),
        ];
    }

}
