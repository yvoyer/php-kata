<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use Star\Kata\Model\Environment;

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
     * @var \FilesystemIterator
     */
    private $filesystem;

    /**
     * @param string $basePath
     */
    public function __construct($basePath)
    {
        $this->classGenerator = new ClassGenerator($basePath);
        $this->filesystem = new \FilesystemIterator($basePath);
    }

    /**
     * @param string $className
     */
    public function generateClass($className)
    {
        $this->classGenerator->generate($className);
    }

    /**
     * Check if the environment already contains data.
     *
     * @return bool
     */
    public function isClean()
    {
        return ! $this->filesystem->valid();
    }
}
