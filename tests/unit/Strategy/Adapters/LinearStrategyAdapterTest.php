<?php

namespace Tests\unit\Strategy\Adapters;

use App\Strategy\Adapters\LinearStrategyAdapter;
use App\Strategy\LinearStrategy;
use App\Values\Product;

class LinearStrategyAdapterTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var LinearStrategyAdapter
     */
    private $linearStrategyAdapter;

    protected function _before()
    {
        $this->linearStrategyAdapter = new LinearStrategyAdapter(new LinearStrategy());
    }

    protected function _after()
    {
    }

    public function testCreate()
    {
        $this->tester->assertInstanceOf(LinearStrategyAdapter::class, $this->linearStrategyAdapter);

    }

    public function testResolveSuccessfully()
    {
        $appleProduct = new Product('apple', 200);
        $tomatoProduct = new Product('tomato', 500);
        $list = [
            $appleProduct,
            $tomatoProduct,
        ];

        $result = $this->linearStrategyAdapter->resolve($list, 699);

        $expected = [$tomatoProduct];

        $this->tester->assertEquals($expected, $result);
    }
}