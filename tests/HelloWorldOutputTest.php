<?php
namespace juniorb2ss\LaravelHelloWorldPackage\Tests;

use juniorb2ss\LaravelHelloWorldPackage\TestCase;
use juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage;

/**
 * @coversDefaultClass \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage
 */
class HelloWorldOutputTest extends TestCase
{
    /**
     * @covers \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage::hasConfig
     */
    public function testHasConfig()
    {
        $method = $this->getProtectedMethod(
            LaravelHelloWorldPackage::class,
            [$this->mockConfig()],
            'hasConfig'
        );
        
        $this->assertTrue(
            $method->invokeArgs(
                $this->getPackageInstance(),
                ['laravel-hello-world-package.message']
            )
        );
    }

    /**
     * @covers \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage::getConfig
     */
    public function testGetConfig()
    {
        $method = $this->getProtectedMethod(
            LaravelHelloWorldPackage::class,
            [$this->mockConfig()],
            'getConfig'
        );
        
        $this->assertEquals(
            'Hello World from package!',
            $method->invokeArgs(
                $this->getPackageInstance(),
                ['laravel-hello-world-package.message']
            )
        );
    }

    /**
     * @covers \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage::getMessageStringFromConfig
     */
    public function testGetMessageStringFromConfig()
    {
        $method = $this->getProtectedMethod(
            LaravelHelloWorldPackage::class,
            [$this->mockConfig()],
            'getMessageStringFromConfig'
        );
        $this->assertEquals(
            'Hello World from package!',
            $method->invokeArgs(
                $this->getPackageInstance(),
                ['laravel-hello-world-package.message']
            )
        );
    }

    /**
     * @expectedException \juniorb2ss\LaravelHelloWorldPackage\Exceptions\ConfigNotFoundException
     */
    public function testException()
    {
        $this->configKeys = [
            '' => '',
        ];

        $package = $this->getPackageInstance();

        // test output
        $this->assertEquals(
            'fail!',
            $package->output()
        );
    }

     /**
     * @covers \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage::output
     */
    public function testOutputIsHelloWorldString()
    {
        $package = $this->getPackageInstance();
        $this->assertEquals(
            'Hello World from package!',
            $package->output()
        );
    }

    /**
     * @covers \juniorb2ss\LaravelHelloWorldPackage\LaravelHelloWorldPackage::output
     */
    public function testChangeOutputString()
    {
        $this->configKeys = [
            'laravel-hello-world-package.message' => 'Another!',
        ];

        $package = $this->getPackageInstance();

        // test output
        $this->assertEquals(
            'Another!',
            $package->output()
        );
    }
}
