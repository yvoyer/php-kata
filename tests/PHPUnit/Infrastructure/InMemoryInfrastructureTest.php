<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Infrastructure;

use Star\Kata\Infrastructure\InMemoryInfrastructure;
use Star\Kata\KataDomain\KataService;
use Star\Kata\Model\KataCollection;

/**
 * Class InMemoryInfrastructureTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit\Infrastructure
 *
 * @covers Star\Kata\Infrastructure\InMemoryInfrastructure
 * @uses Star\Kata\Model\KataCollection
 * @uses Star\Kata\KataDomain\KataService
 *
 * @deprecated todo Remove
 */
final class InMemoryInfrastructureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InMemoryInfrastructure
     */
    private $infrastructure;

    public function setUp()
    {
        $this->infrastructure = new InMemoryInfrastructure();
    }

    /**
     * @param $method
     * @param $class
     *
     * @dataProvider provideInfrastructureExpectedObjects
     */
    public function test_should_return_the_service($method, $class)
    {
        $this->assertTrue(method_exists($this->infrastructure, $method), "The infrastructure method {$method} do not exists.");
        $object = $this->infrastructure->{$method}();
        $this->assertInstanceOf($class, $object, "The method {$method} should return instance of {$class}.");
    }

    public function provideInfrastructureExpectedObjects()
    {
        return array(
            array('kataService', KataService::CLASS_NAME),
            array('kataRepository', KataCollection::CLASS_NAME),
        );
    }
}
