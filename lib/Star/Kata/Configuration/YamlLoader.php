<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

use Star\Kata\Exception\Configuration\EmptyConfigurationException;
use Star\Kata\Exception\Configuration\MissingConfigurationException;
use Star\Kata\Exception\RuntimeException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlLoader
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Configuration
 */
class YamlLoader
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $config;

    /**
     * @param string $path The path to the config file
     * @throws \Star\Kata\Exception\RuntimeException
     */
    public function __construct($path)
    {
        if (false === file_exists($path)) {
            throw new RuntimeException("File '{$path}' can't be found.");
        }

        $this->path = $path;
    }

    /**
     * @throws \Star\Kata\Exception\Configuration\EmptyConfigurationException
     * @throws \Star\Kata\Exception\Configuration\MissingConfigurationException
     * @return Configuration
     */
    public function load()
    {
        $this->config = Yaml::parse($this->path);
        if (empty($this->config)) {
            throw new EmptyConfigurationException("The file can't be empty");
        }

        $configuration = new Configuration();

        $this->assertConfigIsPresent('src-path');
        $configuration->setSrcPath($this->config['src-path']);

        $this->assertConfigIsPresent('katas');
        if (false === is_array($this->config['katas'])) {
            throw MissingConfigurationException::getNoKataDefinedException();
        }

        foreach ($this->config['katas'] as $kataName => $kata) {
            $configuration->addKata($kataName);
        }

        return $configuration;
    }

    /**
     * @param string $index
     * @throws \Star\Kata\Exception\Configuration\MissingConfigurationException
     */
    private function assertConfigIsPresent($index)
    {
        if (false === array_key_exists($index, $this->config)) {
            throw MissingConfigurationException::getConfigurationNotDefinedException($index);
        }
    }
}
