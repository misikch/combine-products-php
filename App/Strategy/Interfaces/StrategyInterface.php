<?php

namespace App\Strategy\Interfaces;

use App\Values\Product;

interface StrategyInterface
{
    /**
     * @param Product[] $inputData
     * @param int $sum
     * @return Product[]
     */
    public function resolve(array $inputData, int $sum): array;
}