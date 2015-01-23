<?php

namespace spec\Star\Kata\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Model\Kata;

class KataCollectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(array());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\KataCollection');
    }

    function it_returns_a_kata(Kata $kata)
    {
        $kata->getName()->willReturn('stub');

        $this->addKata($kata);
        $this->getKata('stub')->shouldReturnAnInstanceOf(Kata::CLASS_NAME);
    }

    function it_can_be_constructed_with_katas(Kata $kata)
    {
        $this->beConstructedWith(array($kata));
        $this->count()->shouldReturn(1);
    }
}
