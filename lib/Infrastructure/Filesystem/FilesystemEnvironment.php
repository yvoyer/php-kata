<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use Star\Kata\Domain\Environment;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class FilesystemEnvironment
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\Filesystem
 */
final class FilesystemEnvironment implements Environment
{
    /**
     * @var ClassGenerator
     */
    private $classGenerator;

    /**
     * @var MethodGenerator
     */
    private $methodGenerator;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var SourceFolder
     */
    private $sourceFolder;

    /**
     * @param string $basePath
     * @param string $srcPath todo Make srcPath configurable
     */
    public function __construct($basePath, $srcPath = 'src')
    {
        $this->sourceFolder = new SourceFolder($basePath . DIRECTORY_SEPARATOR . $srcPath);
        $this->classGenerator = new ClassGenerator($this->sourceFolder);
        $this->methodGenerator = new MethodGenerator($this->sourceFolder);
        $this->filesystem = new Filesystem();
    }

    /**
     * @param string $className
     */
    public function generateClass($className)
    {
        $this->classGenerator->generate($className);
    }

    /**
     * @param string $name
     * @param array $args
     */
    public function generateMethod($name, array $args = array())
    {
        $this->methodGenerator->generateMethod($name, $args);
    }

    /**
     * Check if the environment already contains data.
     *
     * @return bool
     */
    public function isClean()
    {
        $iterator = new \FilesystemIterator($this->sourceFolder->url());
        return ! $iterator->valid();
    }

    public function clear()
    {
        $this->filesystem->remove(new \FilesystemIterator($this->sourceFolder->url()));
    }
}
