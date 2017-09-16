<?php

namespace App\Strategy;

use App\Values\Product;

class LinearStrategy
{


    /**
     * @param Product[] $inputArray
     * @return array
     */
    public function makeCombinations(array $inputArray)
    {
        // init
        $results = [[]];

        foreach ($inputArray as $element) {
            foreach ($results as $combination) {
                array_push($results, array_merge(array($element), $combination));
            }
        }

        return $results;
    }

    /**
     * @param Product[] $inputArray
     * @param int $maxAvailableSum
     * @return array
     */
    public function findMaxSum(array $inputArray, int $maxAvailableSum): array
    {
        $currentSum = 0;
        $foundSum = 0;
        $foundId = null;

        foreach ($inputArray as $id => $elements) {
            foreach ($elements as $element) {
                /** @var Product $element */
                $elementPrice = $element->getPrice();
                $currentSum += $elementPrice;
            }

            if ($currentSum <= $maxAvailableSum && $currentSum > $foundSum) {
                $foundSum = $currentSum;
                $foundId = $id;
            }

            $currentSum = 0;
        }

        if ($foundId) {
            return $inputArray[$foundId];
        }

        return [];
    }
}