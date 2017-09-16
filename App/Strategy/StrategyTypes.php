<?php

namespace App\Strategy;


class StrategyTypes
{
    const LINEAR = 'LINEAR';

    public static function getAll(): array
    {
        return [
            self::LINEAR,
        ];
    }
}