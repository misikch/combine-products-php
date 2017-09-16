<?php

namespace Tests\unit\Strategy;

use App\Strategy\LinearStrategy;
use App\Values\Product;

class LinerStategyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var LinearStrategy
     */
    private $linearStrategy;

    protected function _before()
    {
        $this->linearStrategy = new LinearStrategy();
    }

    protected function _after()
    {
    }

    public function testCreate()
    {
        $this->tester->assertInstanceOf(LinearStrategy::class, $this->linearStrategy);

    }

    public function testMakeCombinationSuccessfully()
    {
        $appleProduct = new Product('apple', 200);
        $tomatoProduct = new Product('tomato', 500);
        $list = [
            $appleProduct,
            $tomatoProduct,
        ];

        $result = $this->linearStrategy->makeCombinations($list);

        $expected = [
            [],
            [$appleProduct],
            [$tomatoProduct],
            [$tomatoProduct, $appleProduct]
        ];

        $this->tester->assertEquals($expected, $result);
    }


    public function testFindMaxSumSuccessfully() {
        $appleProduct = new Product('apple', 200);
        $tomatoProduct = new Product('tomato', 500);
        $bananaProduct = new Product('banana', 150);

        $list = [
            [$appleProduct],
            [$tomatoProduct, $appleProduct, $bananaProduct],
            [$appleProduct, $bananaProduct],
        ];

        //1
        $result = $this->linearStrategy->findMaxSum($list, 400);

        $expected = [$appleProduct, $bananaProduct];

        $this->tester->assertEquals($expected, $result);

        //2
        $result = $this->linearStrategy->findMaxSum($list, 250);

        $expected = [$appleProduct];

        $this->tester->assertEquals($expected, $result);
    }
}