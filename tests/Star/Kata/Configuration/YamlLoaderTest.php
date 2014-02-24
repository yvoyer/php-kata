<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\Star\Kata\Configuration;

use Star\Kata\Configuration\YamlLoader;

/**
 * Class YamlLoaderTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\Star\Kata\Configuration
 */
class YamlLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var YamlLoader
     */
    private $loader;

    public function setUp()
    {
        $this->loader = new YamlLoader();
    }

    public function testShouldLoadFromYaml()
    {
        $content = <<<CONTENT
name: kata-name
src-path: path
CONTENT;

        $config = $this->loader->load($content);
        $this->assertInstanceOf('Star\Kata\Configuration\Configuration', $config);
        $this->assertSame('kata-name', $config->getName());
        $this->assertSame('path', $config->getSrcPath());
    }

}
 