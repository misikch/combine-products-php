<?php

namespace App\Constants;

class SourceTypes
{
    const CSV = 'csv';

    public static function getAll(): array
    {
        return [
            self::CSV,
        ];
    }
}