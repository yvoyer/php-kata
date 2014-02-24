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
     * @param string $yaml
     *
     * @return Configuration
     */
    public function load($yaml)
    {
        $config = Yaml::parse($yaml);
        return new Configuration($config['name'], $config['src-path']);
    }
}
 