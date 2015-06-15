<?php

namespace spec\Star\Kata\Infrastructure\InMemory;

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
        $this->shouldHaveType('Star\Kata\Infrastructure\InMemory\KataCollection');
    }

    function it_returns_a_kata(Kata $kata)
    {
        $kata->name()->willReturn('stub');

        $this->addKata($kata);
        $this->findOneByName('stub')->shouldReturnAnInstanceOf('Star\Kata\Model\Kata');
    }

    function it_can_be_constructed_with_katas(Kata $kata)
    {
        $this->beConstructedWith(array($kata));
        $this->count()->shouldReturn(1);
    }
}
