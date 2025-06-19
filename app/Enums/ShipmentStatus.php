<?php

namespace App\Enums;

use App\Enums\Contracts\LabeledEnum;
use App\Enums\Traits\BaseEnum;

enum ShipmentStatus: int implements LabeledEnum
{
    use BaseEnum;
    case PENDING = 1;
    case SHIPPED = 2;
    case DELIVERED = 3;
    case CANCELLED = 4;


    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Hazırlanıyor',
            self::SHIPPED => 'Kargoya Verildi',
            self::DELIVERED => 'Teslim Edildi',
            self::CANCELLED => 'İptal Edildi',
        };
    }
}
