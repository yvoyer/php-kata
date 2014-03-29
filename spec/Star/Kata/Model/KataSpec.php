<?php

namespace spec\Star\Kata\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Exception\RuntimeException;

class KataSpec extends ObjectBehavior
{
    function let(Configuration $config)
    {
        $this->beConstructedWith($config, 'kata-name');
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

    function it_throw_exception_when_no_name_configured(Configuration $config)
    {
        $this->shouldThrow(new RuntimeException('Name should be configured.'))->during__construct($config);
    }

    function it_has_a_description()
    {
        $this->getDescription()->shouldReturn('');
    }
}
