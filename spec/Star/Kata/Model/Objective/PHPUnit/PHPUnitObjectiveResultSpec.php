<?php

namespace spec\Star\Kata\Model\Objective\PHPUnit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Model\Objective\Objective;

/**
 * Class PHPUnitObjectiveResultSpec
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package spec\Star\Kata\Model\Objective\PHPUnit
 */
class PHPUnitObjectiveResultSpec extends ObjectBehavior
{
    function let(Objective $objective)
    {
        $this->beConstructedWith(5, $objective);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Objective\ObjectiveResult');
    }

    function it_can_have_points()
    {
        $this->points()->shouldReturn(5);
        $this->maxPoints()->shouldReturn(5);
    }

    function it_can_be_a_success(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        $this->isSuccess()->shouldReturn(true);
        $this->addFailure($test, $e, $time);
        $this->isSuccess()->shouldReturn(false);
    }

    function it_can_be_a_failure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        $this->isFailure()->shouldReturn(false);
        $this->addFailure($test, $e, $time);
        $this->isFailure()->shouldReturn(true);
    }

    function it_deduce_points_on_failure(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        $this->addFailure($test, $e, $time);
        $this->addFailure($test, $e, $time);
        $this->addFailure($test, $e, $time);
        $this->addFailure($test, $e, $time);
        $this->addFailure($test, $e, $time);
        $this->points()->shouldReturn(0);
    }
}
