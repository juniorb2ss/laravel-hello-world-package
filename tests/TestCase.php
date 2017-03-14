<?php
namespace juniorb2ss\LaravelHelloWorldPackage;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage;
use Mockery;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
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

    protected function getPackageInstance()
    {
        return new LaravelHelloWorldPackage($this->config);
    }
}
