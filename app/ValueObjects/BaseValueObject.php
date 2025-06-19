<?php 

namespace App\ValueObjects;

abstract class BaseValueObject
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}