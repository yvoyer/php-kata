<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

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
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @return Configuration
     */
    public function load()
    {
        $config = Yaml::parse($this->path);
        $configuration = new Configuration();

        $configuration->setSrcPath($config['src-path']);
        foreach ($config['katas'] as $kataName => $kata) {
            $configuration->addKata($kataName);
        }

        return $configuration;
    }
}
