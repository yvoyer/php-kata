<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

use Star\Kata\Exception\Configuration\EmptyConfigurationException;
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
     * @param string $path
     *
     * @throws \Star\Kata\Exception\Configuration\EmptyConfigurationException
     * @throws \Star\Kata\Exception\RuntimeException
     * @return Configuration
     */
    public function load($path)
    {
        if (false === file_exists($path)) {
            throw new RuntimeException("File '{$path}' can't be found.");
        }

        $config = Yaml::parse($path);
        if (empty($config)) {
            throw new EmptyConfigurationException("The file can't be empty");
        }

        $configuration = new Configuration();
        $configuration->load($config);

        return $configuration;
    }
}
