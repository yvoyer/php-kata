<?php

namespace spec\Star\Kata\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Model\Kata;

class FibonacciKataSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Data\FibonacciKata');
    }

    function it_is_a_kata()
    {
        $this->shouldHaveType(Kata::CLASS_NAME);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('fibonacci');
    }
}
