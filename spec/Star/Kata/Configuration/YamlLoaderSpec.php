<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Configuration\Configuration;

class YamlLoaderSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $validConfig;

    function let()
    {
        $this->validConfig = $this->getFixtureRoot('yaml-config.yml');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Configuration\YamlLoader');
    }

    function it_is_building_configuration()
    {
        $this->load($this->validConfig)->shouldReturnAnInstanceOf(Configuration::CLASS_NAME);
    }

    function it_is_building_a_configuration_with_name()
    {
        $this->load($this->validConfig)->getKata('kata1')->getName()->shouldReturn('kata1');
        $this->load($this->validConfig)->getKata('kata2')->getName()->shouldReturn('kata2');
    }

    function it_is_building_a_configuration_with_src_path()
    {
        $this->load($this->validConfig)->getSrcPath()->shouldReturn('src-path');
    }

    function it_throw_exception_when_file_do_not_exists()
    {
        $this->shouldThrow('Star\Kata\Exception\RuntimeException')->duringLoad('not-found-file.yml');
    }

    private function getFixtureRoot($file)
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . $file;
    }

    function it_throw_exception_when_empty_configuration()
    {
        $this->shouldThrow('Star\Kata\Exception\Configuration\EmptyConfigurationException')
            ->duringLoad($this->getFixtureRoot('missing-config-empty.yml'));
    }
}
