<?php

namespace App\Strategy\Adapters;


use App\Strategy\Interfaces\StrategyInterface;
use App\Strategy\LinearStrategy;
use App\Values\Product;

class LinearStrategyAdapter implements StrategyInterface
{

    /**
     * @var LinearStrategy
     */
    private $linearStrategy;

    public function __construct(LinearStrategy $linearStrategy)
    {
        $this->linearStrategy = $linearStrategy;
    }

    /**
     * @param array $inputData
     * @param int $sum
     * @return Product[]
     */
    public function resolve(array $inputData, int $sum): array
    {
        $allAvailableCombinations = $this->linearStrategy->makeCombinations($inputData);

        return $this->linearStrategy->findMaxSum($allAvailableCombinations, $sum);
    }
}