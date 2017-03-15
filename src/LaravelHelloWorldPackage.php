<?php

namespace juniorb2ss\LaravelHelloWorldPackage;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\View\Factory;
use juniorb2ss\LaravelHelloWorldPackage\Exceptions\ConfigNotFoundException;

class LaravelHelloWorldPackage
{

    /**
     * @param ConfigRepository $config
     */
    public function __construct(ConfigRepository $config)
    {
        $this->config = $config;
    }

    /**
     * Has config key?
     * @return boolean
     */
    private function hasConfig($config)
    {
        return ($this->config->has($config));
    }

    /**
     * Get config value
     * @return mix
     */
    public function getConfig($config)
    {
        if (!$this->hasConfig($config)) {
            throw new ConfigNotFoundException();
        }

        return ($this->config->get($config));
    }

    /**
     * Return string message
     * @return string
     */
    private function getMessageStringFromConfig()
    {
        return $this->getConfig('laravel-hello-world-package.message');
    }

    /**
     * Get string message
     * @return string
     */
    public function output()
    {
        return ($this->getMessageStringFromConfig());
    }
}
