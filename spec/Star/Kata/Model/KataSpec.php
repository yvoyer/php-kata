<?php

namespace spec\Star\Kata\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Exception\InvalidArgumentException;
use Star\Kata\Exception\RuntimeException;

class KataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('kata-name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Kata');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('kata-name');
    }

    function it_throw_exception_when_no_step_configured()
    {
        $this->shouldThrow(new RuntimeException('Should have at least one step'))->duringStart();
    }
}
