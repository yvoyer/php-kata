<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\Kata;

class ConfigurationSpec extends ObjectBehavior
{
    function let()
    {
    }

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
        $this->addKata(new Kata('name'));
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

    function it_must_load_the_configuration_from_array()
    {
        $parameters = array(
            'php-kata' => array(
                'src-path' => 'src-path',
                'katas' => array(
                    'kata1' => array(
                        'name' => 'kata-name',
                        'class' => Kata::CLASS_NAME,
                    ),
                ),
            ),
        );
        $this->load($parameters);

        $this->getSrcPath()->shouldReturn('src-path');
        $this->getKata('kata-name')->shouldReturnAnInstanceOf(Kata::CLASS_NAME);
        $this->getKata('kata-name')->getName()->shouldReturn('kata-name');
    }
}
