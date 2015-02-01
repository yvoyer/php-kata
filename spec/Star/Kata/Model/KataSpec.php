<?php

namespace spec\Star\Kata\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Exception\RuntimeException;
use Star\Kata\Model\Kata;
use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\StartedKata;
use Star\Kata\Model\Step\Step;

class KataSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__, 'kata-name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Kata');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('kata-name');
    }

    function it_throw_exception_when_no_objective_configured()
    {
        $this->shouldThrow(new RuntimeException('Should have at least one objective.'))->duringStart();
    }

    function it_throw_exception_when_no_name_configured()
    {
        $this->shouldThrow(new RuntimeException('Name should be configured.'))->during__construct(__DIR__);
    }

    function it_has_a_description()
    {
        $this->getDescription()->shouldReturn('');
    }

    function it_starts_the_kata(Objective $objective)
    {
        $this->addObjective($objective);

        $this->start()->shouldReturnAnInstanceOf(StartedKata::CLASS_NAME);
    }
}
