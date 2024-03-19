<?php

namespace App;

use Exception;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

abstract class BaseEnum
{
    public static function toArray(): array
    {
        $reflectionClass = new \ReflectionClass(static::class);
        return $reflectionClass->getConstants();
    }

    public static function isValidValue($value): bool
    {
        return in_array($value, static::toArray(), true);
    }
}
