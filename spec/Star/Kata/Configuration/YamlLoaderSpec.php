<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;

class YamlLoaderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'yaml-config.yml');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Configuration\YamlLoader');
    }

    function it_is_building_configuration()
    {
        $this->load()->shouldReturnAnInstanceOf(Configuration::CLASS_NAME);
    }

    function it_is_building_a_configuration_with_name()
    {
        $this->load()->getKata('kata1')->getName()->shouldReturn('kata1');
        $this->load()->getKata('kata2')->getName()->shouldReturn('kata2');
    }

    function it_is_building_a_configuration_with_src_path()
    {
        $this->load()->getSrcPath()->shouldReturn('src-path');
    }
}
