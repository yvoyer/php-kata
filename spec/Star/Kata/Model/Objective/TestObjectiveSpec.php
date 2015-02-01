<?php

namespace spec\Star\Kata\Model\Objective;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\Step\Step;

class TestObjectiveSpec extends ObjectBehavior
{
    /**
     * @var \PHPUnit_Framework_Test
     */
    private $test;

    function let(\PHPUnit_Framework_Test $test)
    {
        $this->test = $test;
        $this->beConstructedWith('test-name', $this->test);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Objective\TestObjective');
    }

    function it_is_an_objective()
    {
        $this->shouldHaveType('Star\Kata\Model\Objective\Objective');
    }

    function it_has_a_name()
    {
        $this->getDescription()->shouldReturn('test-name');
    }

//    function it_checks_whether_the_tests_pass(\PHPUnit_Framework_TestResult $result)
//    {
//        $result->count()->willReturn(1);
//        $result->failureCount()->willReturn(1);
//        $this->test->run()->willReturn($result);
//
//        $this->validate()->shouldReturnAnInstanceOf(ObjectiveResult::CLASS_NAME);
//    }
}
