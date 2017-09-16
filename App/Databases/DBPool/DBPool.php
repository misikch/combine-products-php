<?php

namespace App\Databases\DBPool;


use App\Databases\DBPool\Exceptions\DBPoolException;

class DBPool
{

    /**
     * @var array
     */
    private $pool;
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->pool = [];
    }

    /**
     * @param string $alias
     * @return mixed
     * @throws DBPoolException
     */
    public function get(string $alias)
    {
        if (key_exists($alias, $this->pool)) {
            return $this->pool[$alias];
        }

        if (key_exists($alias, $this->config) && method_exists($this, $alias)) {
            return $this->$alias();
        }

        throw new DBPoolException("alias $alias does not exist in config, or method $alias does not exist in DBPool class");
    }


    /**
     * @return string
     * @throws DBPoolException
     */
    private function csv(): string
    {
        if (!key_exists('csv', $this->config) || !key_exists('file', $this->config['csv'])) {
            throw new DBPoolException("can't find key 'csv' => 'file' in config");
        }

        if (file_exists($this->config['csv']['file'])) {
            return $this->config['csv']['file'];
        }

        throw new DBPoolException("Can't find file: " . $this->config['csv']['file']);
    }
}