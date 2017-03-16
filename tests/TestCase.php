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

        $this->configKeys = $this->getConfigArray();

        $this->config = $this->mockConfig();
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
     *
     */
    public function getConfigArray()
    {
        return [
            'laravel-hello-world-package.message' => 'Hello World from package!',
        ];
    }

    /**
     *
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
        return new LaravelHelloWorldPackage($this->config);
    }
}
