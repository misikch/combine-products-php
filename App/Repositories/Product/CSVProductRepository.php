<?php

namespace App\Repositories\Product;


use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Values\Product;

class CSVProductRepository implements ProductRepositoryInterface
{

    private $csvFileName;

    public function __construct(string $csvFileName)
    {
        $this->csvFileName = $csvFileName;
    }


    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        $rawArray = $this->getContentAsArray();

        $products = array_map(function ($element) {
            return new Product($element[0], (int)$element[1]);

        }, $rawArray);

        return $products;
    }

    private function getContentAsArray(): array
    {
        $result = [];
        $file = fopen($this->csvFileName, 'r');
        while (false !== ($line = fgetcsv($file))) {
            if (2 === count($line) && isset($line[0], $line[1])) {
                $result[] = $line;
            }
        }
        fclose($file);

        return $result;
    }
}