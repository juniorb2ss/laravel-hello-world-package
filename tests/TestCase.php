<?php
namespace juniorb2ss\LaravelHelloWorldPackage;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage;
use Mockery;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @inheritDoc
     * @return object
     */
    protected function prepareConfigMock()
    {
        $this->config = $this->mockConfig();

        $this->config->shouldReceive('has')->andReturnUsing(function ($key) {
            return array_has(
                $this->getConfigArray(),
                $key,
                false
            );
        });

        $this->config->shouldReceive('get')->andReturnUsing(function ($key) {
            return array_get(
                $this->getConfigArray(),
                $key,
                null
            );
        });

        return $this->config;
    }

    /**
     * Return config array
     * @return array self::configs
     */
    public function getConfigArray()
    {
        return $this->configs;
    }

    /**
     * Get \Illuminate\Contracts\Config\Repository Mock
     * @return object
     */
    public function mockConfig()
    {
        return Mockery::mock(ConfigRepository::class);
    }

    /**
     * Get protected method reflection
     * @param ClassName $class Class to reflection operations
     * @param array $constructArgs Args to class construct
     * @param string $name Method name
     *
     * @return object method visible instance
     */
    protected static function getProtectedMethod($class, $constructArgs, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * Get package class instance
     * @return \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage
     */
    protected function getPackageInstance()
    {
        $configMock = $this->prepareConfigMock();

        return (new LaravelHelloWorldPackage($configMock));
    }
}
