<?php

namespace spec\Star\Kata\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileTemplateSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('ClassName', 'Content');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\FileTemplate');
    }

    function it_has_a_class_name()
    {
        $this->getClassName()->shouldReturn('ClassName');
    }

    function it_has_a_content()
    {
        $this->getContent()->shouldReturn('Content');
    }
}
