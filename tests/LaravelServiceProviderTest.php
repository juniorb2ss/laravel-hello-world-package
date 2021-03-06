<?php
namespace juniorb2ss\LaravelHelloWorldPackage\Tests;

use Illuminate\Contracts\Foundation\Application as ApplicationInterface;
use juniorb2ss\LaravelHelloWorldPackage\Providers\LaravelServiceProvider;
use juniorb2ss\LaravelHelloWorldPackage\TestCase;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Mockery;
use ArrayAccess;

/**
 *
 */
class LaravelServiceProviderTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->config = Mockery::mock();
        $this->app = Mockery::mock(ArrayAccess::class);
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->app->shouldReceive('offsetGet')->zeroOrMoreTimes()->with('path.config')->andReturn('/some/config/path');
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $this->app->shouldReceive('offsetGet')->zeroOrMoreTimes()->with('config')->andReturn($this->config);
        /** @var ApplicationInterface $app */
        $app = $this->app;
        $this->provider = new LaravelServiceProvider($app);
    }

    /**
     * Test boot provider.
     */
    public function testBoot()
    {
        $this->provider->boot();
    }

    /**
     * Test getConfigRepository
     */
    public function testGetConfigRepository()
    {
        $method = $this->getProtectedMethod(LaravelServiceProvider::class, [], 'getConfigRepository');
        $this->assertEquals(
            $this->config,
            $method->invokeArgs($this->provider, [])
        );
    }

    /**
     * Test Register
     */
    public function testRegister()
    {
        $this->assertNull($this->provider->register());
    }
}
