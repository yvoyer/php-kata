<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;

final class SourceFolderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SourceFolder
     */
    private $sourceFolder;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');

        $this->sourceFolder = new SourceFolder($this->root->url());
    }

    /**
     * @expectedException        \Star\Kata\Infrastructure\Filesystem\Exception\SourceFolderException
     * @expectedExceptionMessage The source folder 'vfs://root/invalid' do not exists.
     */
    public function test_it_should_throw_exception_when_folder_not_created()
    {
        $this->sourceFolder = new SourceFolder($this->root->url() . DIRECTORY_SEPARATOR . 'invalid');
    }

    public function test_should_write_file()
    {
        $this->assertFalse($this->root->hasChild('file.txt'));
        $filename = $this->sourceFolder->writeFile('file.txt', 'content');
        $this->assertSame('vfs://root/file.txt', $filename);
        $this->assertTrue($this->root->hasChild('file.txt'));
        $this->assertSame('content', file_get_contents($filename));
    }

    public function test_it_should_read_the_file()
    {
        $this->assertFalse($this->root->hasChild('file'));
        $this->assertSame('', $this->sourceFolder->readFile('file'), 'Return empty when file not found');

        $file = new vfsStreamFile('file');
        $file->setContent('content');
        $this->root->addChild($file);
        $this->assertTrue($this->root->hasChild('file'));
        $this->assertSame('content', $this->sourceFolder->readFile('file'), 'Returns content when file found');
    }
}
