<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Objective;

use Star\Kata\KataMock;

/**
 * Class StandardResultTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Objective
 */
final class StandardResultTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var StandardResult
     */
    private $result;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $objective;

    public function setUp()
    {
        $this->objective = $this->getMockObjective();
        $this->result = new StandardResult(2, $this->objective);
    }

    public function test_it_should_store_the_maximum_points()
    {
        $this->assertSame(2, $this->result->maxPoints());
    }

    public function test_it_should_have_default_points()
    {
        $this->assertSame(2, $this->result->points());
    }

    /**
     * @depends test_it_should_have_default_points
     */
    public function test_it_should_deduce_points_on_failure()
    {
        $this->result->failRequirement('required');
        $this->assertSame(1, $this->result->points());
        $this->result->failRequirement('required');
        $this->assertSame(0, $this->result->points());
        $this->result->failRequirement('required');
        $this->assertSame(0, $this->result->points());
    }

    public function test_it_should_fail_when_one_requirement_failed()
    {
        $this->assertFalse($this->result->isFailure());
        $this->result->failRequirement('fail');
        $this->assertTrue($this->result->isFailure());
    }

    public function test_it_should_success_when_no_requirements_failed()
    {
        $this->assertTrue($this->result->isSuccess());
        $this->result->failRequirement('fail');
        $this->assertFalse($this->result->isSuccess());
    }

    public function test_it_should_have_an_objective()
    {
        $this->assertSame($this->objective, $this->result->objective());
    }
}
