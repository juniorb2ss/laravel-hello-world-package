<?php
namespace juniorb2ss\LaravelHelloWorldPackage\Tests;

use juniorb2ss\LaravelHelloWorldPackage\TestCase;

/**
 *
 */
class HelloWorldOutputTest extends TestCase
{   
    /**
     * @test 
     * @covers LaravelHelloWorldPackage::output
     */
    public function testOutputIsHelloWorldString()
    {
        $package = $this->getPackageInstance();
        $this->assertEquals(
            'Hello World from package!',
            $package->output()
        );
    }

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
}
