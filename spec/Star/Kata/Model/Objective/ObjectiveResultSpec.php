<?php

namespace spec\Star\Kata\Model\Objective;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ObjectiveResultSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(5);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Objective\ObjectiveResult');
    }

    function it_can_have_points()
    {
        $this->getPoints()->shouldReturn(5);
        $this->addFailure(1);
        $this->getPoints()->shouldReturn(4);
    }

    function it_can_be_a_success()
    {
        $this->isSuccess()->shouldReturn(true);
        $this->addFailure(1);
        $this->isSuccess()->shouldReturn(false);
    }

    function it_can_be_a_failure()
    {
        $this->isFailure()->shouldReturn(false);
        $this->addFailure(1);
        $this->isFailure()->shouldReturn(true);
    }

    function it_has_a_minimum_of_zero_point_on_failure()
    {
        $this->addFailure(10);
        $this->getPoints()->shouldReturn(0);
    }
}
