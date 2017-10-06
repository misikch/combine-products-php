<?php

namespace App\Constants;

class SourceTypes
{
    const CSV = 'csv';

    public static function getAll(): array
    {
    	$selfClass = new \ReflectionClass(self::class);
    	return $selfClass->getConstants();
    }
}