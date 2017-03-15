<?php
namespace juniorb2ss\LaravelHelloWorldPackage;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage;
use Mockery;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->configKeys = [
            'laravel-hello-world-package.message' => 'Hello World from package!',
        ];

        $this->config = Mockery::mock(ConfigRepository::class);
        $this->config->shouldReceive('has')->andReturnUsing(function ($key) {
            if (isset($this->configKeys[$key])) {
                return true;
            }
            return false;
        });

        $this->config->shouldReceive('get')->andReturnUsing(function ($key) {
            if (isset($this->configKeys[$key])) {
                return $this->configKeys[$key];
            }
            return null;
        });
    }

    /**
     * [getMethod description]
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    protected static function getProtectedMethod($class, $name)
    {
        $class = new \ReflectionClass($class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    protected function getPackageInstance()
    {
        return new LaravelHelloWorldPackage($this->config);
    }
}
