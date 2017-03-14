<?php

namespace juniorb2ss\LaravelHelloWorldPackage;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\View\Factory;
use juniorb2ss\LaravelHelloWorldPackage\Exceptions\ConfigNotFoundException;

class LaravelHelloWorldPackage
{

    /**
     * [__construct description]
     * @param Factory          $views  [description]
     * @param ConfigRepository $config [description]
     */
    public function __construct(ConfigRepository $config)
    {
        $this->config = $config;
    }

    /**
     * [hasConfig description]
     * @return boolean [description]
     */
    private function hasConfig($config)
    {
        return ($this->config->has($config));
    }

    /**
     * [getConfig description]
     * @return [type] [description]
     */
    public function getConfig($config)
    {
        if (!$this->hasConfig($config)) {
            throw new ConfigNotFoundException();
        }

        return ($this->config->get($config));
    }

    /**
     * [getMessageStringFromConfig description]
     * @return [type] [description]
     */
    private function getMessageStringFromConfig()
    {
        return $this->getConfig('laravel-hello-world-package.message');
    }

    /**
     * [output description]
     * @return [type] [description]
     */
    public function output()
    {
        return ($this->getMessageStringFromConfig());
    }
}
