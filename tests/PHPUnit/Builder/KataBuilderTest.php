<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Builder;

use Star\Kata\Model\Kata;

/**
 * Class KataBuilderTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Builder
 *
 * @covers Star\Kata\Builder\KataBuilder
 * @uses Star\Kata\Builder\ObjectiveBuilder
 * @uses Star\Kata\Model\Objective\ConfigurableObjective
 * @uses Star\Kata\Model\Kata
 */
final class KataBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KataBuilder
     */
    private $builder;

    public function setUp()
    {
        $this->builder = new KataBuilder();
    }

    public function test_build_should_always_return_a_kata()
    {
        $this->assertInstanceOfKata($this->builder->build());
    }

    /**
     * @depends test_build_should_always_return_a_kata
     */
    public function test_should_return_a_kata_with_default_name()
    {
        $kata = $this->builder->build();
        $this->assertSame('kata-1', $kata->getName());
    }

    /**
     * @depends test_build_should_always_return_a_kata
     */
    public function test_should_return_a_different_instance_on_successive_build()
    {
        $this->assertNotSame($this->builder->build(), $this->builder->build(), 'Should not be same instance');
        $this->assertNotEquals($this->builder->build(), $this->builder->build(), 'Should not be same entity');
    }

    /**
     * @depends test_build_should_always_return_a_kata
     */
    public function test_should_change_name_of_kata_on_each_build()
    {
        $this->assertSame('kata-1', $this->builder->build()->getName());
        $this->assertSame('kata-2', $this->builder->build()->getName());
        $this->assertSame('kata-3', $this->builder->build()->getName());
    }

    /**
     * @depends test_build_should_always_return_a_kata
     */
    public function test_should_build_kata_with_name()
    {
        $kata = $this->builder
            ->withName('my-name')
            ->build();

        $this->assertSame('my-name', $kata->getName());
    }

    /**
     * @depends test_build_should_always_return_a_kata
     */
    public function test_should_be_built_with_objective()
    {
        $kata = $this->builder
            ->withObjective('Function test should return true.', function() { })
            ->build();

        $this->assertAttributeCount(1, 'objectives', $kata);
    }

    public function test_should_reset_the_objectives_on_multiple_calls()
    {
        $this->builder
            ->withObjective('objective 1', function() {})
            ->build();
        $kata = $this->builder
            ->withObjective('Objective 2', function() {})
            ->build();

        $this->assertAttributeCount(1, 'objectives', $kata);
    }

    private function assertInstanceOfKata($object)
    {
        $this->assertInstanceOf(Kata::CLASS_NAME, $object);
    }
}
