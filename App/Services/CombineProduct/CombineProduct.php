<?php

namespace App\Services\CombineProduct;

use App\Databases\DBPool\DBPool;
use App\Factories\Repositories\Product\Interfaces\ProductRepositoryFactoryInterface;
use App\Factories\Strategy\Interfaces\StrategyFactoryInterface;
use App\Repositories\Product\Interfaces\ProductRepositoryInterface;
use App\Services\CombineProduct\Exceptions\CombineProductException;
use App\Services\CombineProduct\Exceptions\CombineProductServiceInvalidArgumentException;
use App\Services\Service;
use App\Strategy\Interfaces\StrategyInterface;
use App\Values\Product;

class CombineProduct extends Service {

    /**
     * @param int $sum
     * @param string $algorithm
     * @param string $source
     * @return Product[]|array
     * @throws CombineProductException
     */
    public function combine(int $sum, string $algorithm, string $source): array {

        $productRepository = $this->getProductsRepository($source);

        $productsList = $productRepository->getAll();

        if(!$productsList) {
            throw new CombineProductException("Product list is empty.");
        }

        $strategyResolver = $this->getStrategyResolver($algorithm);

        return $strategyResolver->resolve($productsList, $sum);
    }


    /**
     * @param string $source
     * @return ProductRepositoryInterface
     */
    public function getProductsRepository(string $source): ProductRepositoryInterface {
        $factoryClassName = 'App\\Factories\\Repositories\\Product\\'
            . ucfirst(strtolower($source)) . 'ProductRepositoryFactory';

        if (!class_exists($factoryClassName)) {
            throw new CombineProductServiceInvalidArgumentException("Can't find factory class $factoryClassName");
        }

        /**
         * @var DBPool $dbPool
         */
        $dbPool = $this->dic['dbPool'];
        /**
         * @var ProductRepositoryFactoryInterface $factory
         */
        $factory = new $factoryClassName($dbPool);

        return $factory->getProductRepository();
    }


    public function getStrategyResolver(string $algorithm): StrategyInterface {
        $strategyFactoryClassName = 'App\\Factories\\Strategy\\'
            . ucfirst(strtolower($algorithm)) . 'StrategyFactory';

        if(!class_exists($strategyFactoryClassName)) {
            throw new CombineProductServiceInvalidArgumentException("Can't find factory class $strategyFactoryClassName");
        }

        /**
         * @var StrategyFactoryInterface $factory
         */
        $factory = new $strategyFactoryClassName();

        return $factory->getStrategy();
    }
}