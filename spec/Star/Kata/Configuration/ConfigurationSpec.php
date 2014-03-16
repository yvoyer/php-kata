<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\Kata;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Configuration\Configuration');
    }

    function it_must_throw_exception_when_kata_not_found()
    {
        $this->shouldThrow('Star\Kata\Exception\InvalidArgumentException')->duringGetKata('not-found');
    }

    function it_must_return_a_kata_with_configured_name()
    {
        $this->addKata('name');
        $this->getKata('name')->shouldReturnAnInstanceOf(Kata::CLASS_NAME);
        $this->getKata('name')->getName()->shouldReturn('name');
    }

    function it_must_throw_exception_when_src_path_not_set()
    {
        $this->shouldThrow('Star\Kata\Exception\RuntimeException')->duringGetSrcPath();
    }

    function it_must_return_src_path_when_set()
    {
        $this->setSrcPath('path');
        $this->getSrcPath()->shouldReturn('path');
    }
}
