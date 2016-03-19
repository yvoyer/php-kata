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
use Star\Kata\KataMock;

/**
 * Class FilesystemEnvironmentTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\Filesystem
 */
final class FilesystemEnvironmentTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var FilesystemEnvironment
     */
    private $environment;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $startedKata;

    public function setUp()
    {
        $this->startedKata = $this->getMockStartedKata();
        $this->root = vfsStream::setup('root');
        $this->environment = new FilesystemEnvironment($this->root->url(), '');
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

    public function test_it_should_return_the_current_kata()
    {
        $file = new vfsStreamFile('.current_kata');
        $file->setContent('current');
        $this->root->addChild($file);
        $this->assertSame('current', $this->environment->currentKata());
    }

    /**
     * @expectedException        \Star\Kata\Domain\Exception\CurrentKataException
     * @expectedExceptionMessage The environment has no current kata available. Did you start any yet?
     */
    public function test_it_should_throw_exception_when_no_current_kata()
    {
        $this->assertFalse($this->root->hasChild('.current_kata'));
        $this->environment->currentKata();
    }

    public function test_it_should_publish_events_on_loaded_environment()
    {
        $publisher = $this->getMockKataEventPublisher();
        $publisher
            ->expects($this->once())
            ->method('publish');

        $this->environment->setPublisher($publisher);
        $this->environment->publish($this->getMockKataEvent());
    }

    /**
     * @expectedException        \Star\Kata\Domain\Exception\EnvironmentException
     * @expectedExceptionMessage The environment is not loaded.
     */
    public function test_it_should_throw_exception_when_publishing_on_not_loaded_env()
    {
        $this->environment->publish($this->getMockKataEvent());
    }
}
