<?php

namespace spec\Star\Kata\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\ClassTemplate;
use Star\Kata\Model\Kata;

class FibonacciKataSpec extends ObjectBehavior
{
    function let(Configuration $config)
    {
        $this->beConstructedWith($config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Data\FibonacciKata');
    }

    function it_is_a_kata()
    {
        $this->shouldHaveType(Kata::CLASS_NAME);
    }

    function it_is_a_class_template()
    {
        $this->shouldHaveType(ClassTemplate::INTERFACE_NAME);
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('fibonacci');
    }
}
