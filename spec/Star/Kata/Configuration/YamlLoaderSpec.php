<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;
use Star\Kata\Exception\Configuration\MissingConfigurationException;

class YamlLoaderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith($this->getFixtureRoot('yaml-config.yml'));
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

    function it_throw_exception_when_file_do_not_exists()
    {
        $this->shouldThrow('Star\Kata\Exception\RuntimeException')->during('__construct', array('not-found-file.yml'));
    }

    private function getFixtureRoot($file)
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . $file;
    }

    function it_throw_exception_when_empty_configuration()
    {
        $this->beConstructedWith($this->getFixtureRoot('missing-config-empty.yml'));
        $this->shouldThrow('Star\Kata\Exception\Configuration\EmptyConfigurationException')->duringLoad();
    }

    function it_throw_exception_when_src_path_not_defined()
    {
        $this->beConstructedWith($this->getFixtureRoot('missing-config-src-path.yml'));
        $this->shouldThrow(MissingConfigurationException::getConfigurationNotDefinedException('src-path'))->duringLoad();
    }

    function it_throw_exception_when_katas_not_defined()
    {
        $this->beConstructedWith($this->getFixtureRoot('missing-config-katas.yml'));
        $this->shouldThrow(MissingConfigurationException::getConfigurationNotDefinedException('katas'))->duringLoad();
    }

    function it_throw_exception_when_no_katas_is_defined()
    {
        $this->beConstructedWith($this->getFixtureRoot('missing-config-no-katas.yml'));
        $this->shouldThrow(MissingConfigurationException::getNoKataDefinedException())->duringLoad();
    }

    function it_throw_exception_when_no_kata_class_is_defined()
    {
        $this->beConstructedWith($this->getFixtureRoot('missing-config-class-name.yml'));
        $this->shouldThrow(MissingConfigurationException::getNoKataDefinedException())->duringLoad();
    }
}
