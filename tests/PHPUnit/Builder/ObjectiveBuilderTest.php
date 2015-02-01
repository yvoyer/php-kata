<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Builder;

use Star\Kata\Model\Objective\Objective;

/**
 * Class ObjectiveBuilderTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Builder
 */
final class ObjectiveBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectiveBuilder
     */
    private $builder;

    public function setUp()
    {
        $this->builder = new ObjectiveBuilder();
    }

    public function test_should_always_build_objectives()
    {
        $this->assertInstanceOfObjective($this->builder->build());
    }

    public function test_should_use_default_objective_definition()
    {
        $this->assertSame('Objective 1', $this->builder->build()->getDescription());
    }

    public function test_should_change_default_objective_definition_on_successive_calls()
    {
        $this->assertSame('Objective 1', $this->builder->build()->getDescription());
        $this->assertSame('Objective 2', $this->builder->build()->getDescription());
        $this->assertSame('Objective 3', $this->builder->build()->getDescription());
    }

    public function test_should_use_specified_objective_definition()
    {
        $objective = $this->builder
            ->withDescription('my-description')
            ->build();

        $this->assertSame('my-description', $objective->getDescription());
    }

    public function test_should_use_specified_assert_code()
    {
        $code = function() {};
        $objective = $this->builder
            ->withAssertCode($code)
            ->build();

        $this->assertAttributeSame($code, 'assertCode', $objective);
    }

    public function test_should_use_default_assert_code()
    {
        $this->assertAttributeInstanceOf('\Closure', 'assertCode', $this->builder->build());
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage The assertion code should be configured.
     */
    public function test_should_configure_code_to_throw_exception_when_not_defined()
    {
        $this->builder->build()->validate();
    }

    private function assertInstanceOfObjective($object)
    {
        $this->assertInstanceOf(Objective::OBJECTIVE_NAME, $object);
    }
}
