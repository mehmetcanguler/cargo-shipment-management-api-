<?php

namespace App\ValueObjects;

class Dimensions extends BaseValueObject
{
    public float $desi;
    public function __construct(
        public float|int $width,
        public float|int $height,
        public float|int $length
    ) {
        $this->desi = $this->desi();
    }

    public function toArray(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
        ];
    }

    public static function fromRequest(array $data): static
    {
        return new self(
            width: $data['width'] ?? 0,
            height: $data['height'] ?? 0,
            length: $data['length'] ?? 0
        );
    }

    public function volume(): float
    {
        return $this->width * $this->height * $this->length;
    }
    public function desi(): float
    {
        return round($this->volume() / 5000, 2);
    }
}
