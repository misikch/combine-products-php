<?php

namespace App\Console;

use App\Console\Exceptions\ConsoleApplicationException;
use App\Databases\DBPool\DBPool;
use App\Services\CombineProduct\CombineProduct;
use Pimple\Container;
use Symfony\Component\Console\Application;

class ConsoleApplication extends Application
{


    /**
     * @var Container
     */
    protected $dic;

    /**
     * @var array
     */
    protected $config;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN', array $config)
    {
        parent::__construct($name, $version);

        $this->config = $config;
        $this->dic = new Container();

        $this->initCommands();
        $this->initDBPool();

        $this->initDependencies();
    }

    /**
     * @return Container
     */
    public function getDIC(): Container
    {
        return $this->dic;
    }


    /**
     * init all dependencies
     */
    protected function initDependencies()
    {
        $dic = $this->dic;

        $dic['CombineProductService'] = function () use ($dic) {
            return new CombineProduct($dic);
        };
    }

    protected function initCommands()
    {
        if (!key_exists('commands', $this->config)) {
            throw new ConsoleApplicationException("The config key 'commands' must be defined");
        }

        foreach ($this->config['commands'] as $commandClassName) {
            if (!class_exists($commandClassName)) {
                throw new ConsoleApplicationException("Class with name $commandClassName does not exist");
            }
            $this->add(new $commandClassName);
        }
    }

    protected function initDBPool()
    {
        if (!key_exists('databases', $this->config)) {
            throw new ConsoleApplicationException("the config key 'databases' must be defined");
        }

        $config = $this->config['databases'];

        $this->dic['dbPool'] = function () use ($config) {
            return new DBPool($config);
        };
    }
}