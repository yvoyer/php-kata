<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

/**
 * Class FilesystemEnvironmentTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\Filesystem
 */
final class FilesystemEnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FilesystemEnvironment
     */
    private $environment;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');
        $this->environment = new FilesystemEnvironment($this->root->url());
    }

    public function test_it_should_create_a_class()
    {
        $this->assertFalse($this->root->hasChild('MyClass.php'));
        $this->environment->generateClass('MyClass');
        $this->assertTrue($this->root->hasChild('MyClass.php'));

        /**
         * @var vfsStreamFile $file
         */
        $file = $this->root->getChild('MyClass.php');
        $this->assertContains('class MyClass', $file->getContent());
    }

    public function test_it_should_create_a_function()
    {
        $this->assertFalse($this->root->hasChild('myFunction.php'));
        $this->environment->generateMethod('myFunction');
        $this->assertTrue($this->root->hasChild('myFunction.php'));

        /**
         * @var vfsStreamFile $file
         */
        $file = $this->root->getChild('myFunction.php');
        $this->assertContains('function myFunction()', $file->getContent());
    }

    public function test_it_should_clear_the_environment()
    {
        $this->root->addChild(new vfsStreamFile('someFile.php'));
        $this->assertTrue($this->root->hasChildren());
        $this->assertFalse($this->environment->isClean());
        $this->environment->clear();
        $this->assertTrue($this->environment->isClean());
        $this->assertFalse($this->root->hasChildren());
    }
}
