<?php

namespace App\Commands;

use App\Constants\SourceTypes;
use App\Services\CombineProduct\CombineProduct;
use App\Strategy\StrategyTypes;
use App\Validators\Combine\CombineValidator;
use App\Values\Product;
use Pimple\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CombineCommand extends Command
{
    protected function configure()
    {
        $this->setName('combine')
            ->setDescription('Combine products')
            ->setHelp("selection of products by input sum\n")
            ->setDefinition(
                new InputDefinition([
                    new InputOption('sum', 's', InputOption::VALUE_REQUIRED, 'total sum'),
                    new InputOption('algo', 'a', InputOption::VALUE_OPTIONAL, 'algorithm. Default is linear', StrategyTypes::LINEAR),
                    new InputOption('source', 'src', InputOption::VALUE_OPTIONAL, 'Database source. Default is csv file', SourceTypes::CSV),
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $validator = $this->getCombineValidator();

        if (!$validator->setInput($input->getOptions())->validate()) {
            $output->writeln($validator->getErrors());
            return 400;
        }

        /** @var Container $dic */
        $dic = $this->getApplication()->getDIC();
        /** @var CombineProduct $combineProductService */
        $combineProductService = $dic['CombineProductService'];

        $resultProductList = $combineProductService->combine(
            (int)$input->getOption('sum'),
            $input->getOption('algo'),
            $input->getOption('source')
        );

        $this->outputResult($resultProductList, $output);

        return null;
    }


    private function getCombineValidator(): CombineValidator
    {
        return new CombineValidator();
    }

    /**
     * @param Product[] $resultProductList
     */
    private function outputResult(array $resultProductList, OutputInterface $output)
    {
        $output->writeln("Result:");

        foreach ($resultProductList as $product) {
            $output->writeln($product->getName() . ' -- ' . $product->getPrice());
        }

        $output->writeln("-------------------");
    }
}