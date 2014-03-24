<?php

namespace spec\Star\Kata\Configuration;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Star\Kata\Exception\Configuration\MissingConfigurationException;
use Star\Kata\Exception\Configuration\MissingKataConfigurationException;
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
        $this->load($this->getValidConfigArray());

        $this->getSrcPath()->shouldReturn('src-path');
        $this->getKata('kata-name')->shouldReturnAnInstanceOf(Kata::CLASS_NAME);
        $this->getKata('kata-name')->getName()->shouldReturn('kata-name');
    }

    function it_throw_exception_when_src_path_not_defined()
    {
        $config = $this->getValidConfigArray();
        unset($config['php-kata']['src-path']);
        $this->shouldThrow(
            new MissingConfigurationException($this->getExpectedMissingConfigurationException('src_path', 'php-kata')))
            ->duringLoad($config);
    }

    function it_throw_exception_when_katas_not_defined()
    {
        $config = $this->getValidConfigArray();
        unset($config['php-kata']['katas']);
        $this->shouldThrow(new MissingConfigurationException($this->getExpectedMissingConfigurationException('katas', 'php-kata')))
            ->duringLoad($config);
    }

    function it_throw_exception_when_no_katas_is_defined()
    {
        $config = $this->getValidConfigArray();
        unset($config['php-kata']['katas']['kata1']);
        $this->shouldThrow(MissingConfigurationException::getNoKataDefinedException())
            ->duringLoad($config);
    }

    function it_throw_exception_when_no_kata_class_is_defined()
    {
        $config = $this->getValidConfigArray();
        unset($config['php-kata']['katas']['kata1']['class']);
        $this->shouldThrow(new MissingKataConfigurationException($this->getExpectedMissingConfigurationException('class', 'kata1')))
            ->duringLoad($config);
    }

    private function getExpectedMissingConfigurationException($node, $path)
    {
        return 'The child node "' . $node . '" at path "'. $path . '" must be configured.';
    }

    /**
     *
     * @return array
     */
    private function getValidConfigArray()
    {
        $config = array(
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

        return $config;
    }

    function it_should_build_the_config_even_with_no_existing_class()
    {
        $config = $this->getValidConfigArray();
        $config['php-kata']['katas']['kata1']['class'] = '\SomeNotExistingClass';
        $this->load($config);
        $this->shouldThrow(new \Star\Kata\Exception\InvalidArgumentException("Kata with name 'kata-name' was not found."))
            ->duringGetKata('kata-name');
    }
}
