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
     * @param string $path The path to the config file
     * @throws \Star\Kata\Exception\RuntimeException
     * todo move path to load
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
        $config = Yaml::parse($this->path);
        if (empty($config)) {
            throw new EmptyConfigurationException("The file can't be empty");
        }

        $configuration = new Configuration();
        $configuration->load($config);

//        $this->assertConfigIsPresent('src-path', $config);
//        $configuration->setSrcPath($config['src-path']);
//
//        $this->assertConfigIsPresent('katas', $config);
//        if (false === is_array($config['katas'])) {
//            throw MissingConfigurationException::getNoKataDefinedException();
//        }
//
//        foreach ($config['katas'] as $kataName => $kataConfig) {
//            if (false === is_array($kataConfig)) {
//                throw MissingConfigurationException::getConfigurationNotDefinedException('class');
//            }
//            $this->assertConfigIsPresent('class', $kataConfig);
//
//            $configuration->addKata($kataName);
//        }

        return $configuration;
    }

    /**
     * @param string $index
     * @param array $config
     * @throws \Star\Kata\Exception\Configuration\MissingConfigurationException
     */
    private function assertConfigIsPresent($index, array $config)
    {
        if (false === array_key_exists($index, $config)) {
            throw MissingConfigurationException::getConfigurationNotDefinedException($index);
        }
    }
}
