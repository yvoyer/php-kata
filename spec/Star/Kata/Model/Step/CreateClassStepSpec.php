<?php

namespace spec\Star\Kata\Model\Step;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Generator\ClassGenerator;
use Star\Kata\Model\ClassTemplate;

class CreateClassStepSpec extends ObjectBehavior
{
    /**
     * @var ClassGenerator
     */
    private $generator;

    /**
     * @var ClassTemplate
     */
    private $template;

    function let(ClassGenerator $generator, ClassTemplate $template)
    {
        $this->generator = $generator;
        $this->template = $template;

        $this->beConstructedWith($this->generator, $this->template);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Model\Step\CreateClassStep');
    }

    function it_is_a_step()
    {
        $this->shouldHaveType('Star\Kata\Model\Step\Step');
    }

    function  it_create_a_file()
    {
        $this->template->getClassName()->willReturn('ClassName');
        $this->generator->generate('ClassName');

        $this->init();
    }

    function it_is_initialized_when_file_exists()
    {
        $this->template->getClassName()->willReturn(__NAMESPACE__ . '\CreateClassStepSpec');

        $this->shouldBeInitialized();
    }

    function it_is_not_initialized_when_file_not_present()
    {
        $this->template->getClassName()->willReturn('SomeNotExistingClass');

        $this->shouldNotBeInitialized();
    }
}
