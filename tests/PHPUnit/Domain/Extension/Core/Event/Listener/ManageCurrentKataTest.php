<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Extension\Core\Event\Listener;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use Star\Kata\Domain\Event\KataHasEnded;
use Star\Kata\Domain\Event\KataWasStarted;
use Star\Kata\Domain\KataDTO;
use Star\Kata\Infrastructure\Filesystem\SourceFolder;
use Star\Kata\KataMock;

final class ManageCurrentKataTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var ManageCurrentKata
     */
    private $manager;

    /**
     * @var SourceFolder
     */
    private $sourceFolder;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    public function setUp()
    {
        $this->kata = $this->getMockStartedKata();
        $this->root = vfsStream::setup('root');
        $this->sourceFolder = new SourceFolder($this->root->url());
        $this->manager = new ManageCurrentKata($this->sourceFolder);
    }

    public function test_it_should_create_current_kata_context_when_kata_started()
    {
        $this->kata
            ->method('getName')
            ->willReturn('name');

        $this->assertFalse($this->root->hasChild('.current_kata'));
        $this->manager->onKataWasStarted(new KataWasStarted($this->kata));
        $this->assertTrue($this->root->hasChild('.current_kata'), 'Hidden file should should be created');
        $this->assertSame('name', $this->manager->getCurrentKata());
    }

    public function test_it_should_remove_current_kata_when_kata_ends()
    {
        $this->assertCurrentKataIsDefined('name');

        $this->assertSame('name', $this->manager->getCurrentKata());
        $this->manager->onKataHasEnded(new KataHasEnded('name'));
        $this->assertFalse($this->root->hasChild('.current_kata'), 'Hidden file should be deleted');
    }

    /**
     * @expectedException        \Star\Kata\Domain\Exception\CurrentKataException
     * @expectedExceptionMessage The environment has no current kata available. Did you start any yet?
     */
    public function test_it_should_throw_exception_when_file_empty()
    {
        $this->manager->getCurrentKata();
    }

    /**
     * @expectedException        \Star\Kata\Domain\Exception\CurrentKataException
     * @expectedExceptionMessage A request to end kata 'to-delete' as been issued, while the current kata is 'current'.
     */
    public function test_it_should_throw_exception_when_ended_kata_not_the_same_as_current()
    {
        $this->assertCurrentKataIsDefined('current');
        $this->manager->onKataHasEnded(new KataHasEnded('to-delete'));
    }

    private function assertCurrentKataIsDefined($name)
    {
        $file = new vfsStreamFile('.current_kata');
        $file->setContent($name);
        $this->root->addChild($file);
        $this->assertTrue($this->root->hasChild('.current_kata'));
    }
}
