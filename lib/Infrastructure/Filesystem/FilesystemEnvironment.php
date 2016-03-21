<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Filesystem;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Event\EventPublisher;
use Star\Kata\Domain\Event\KataEvent;
use Star\Kata\Domain\Exception\CurrentKataException;
use Star\Kata\Domain\Exception\EnvironmentException;
use Star\Kata\Domain\Visitor\EnvironmentVisitor;
use Star\Kata\Domain\Extension\Core\Event\Listener\ManageCurrentKata;
use Star\Kata\Domain\Extension\KataExtension;
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
     * @var EventPublisher|null
     */
    private $publisher;

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
     * @param EventPublisher $publisher todo move to configuration
     */
    public function setPublisher(EventPublisher $publisher)
    {
        $this->publisher = $publisher;
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

    /**
     * Return the current kata.
     *
     * @return string The name of the kata.
     * @throws CurrentKataException When no current defined
     */
    public function currentKata()
    {
        $currentKataManager = new ManageCurrentKata($this->sourceFolder);
        return $currentKataManager->getCurrentKata();
    }

    /**
     * @param KataEvent $event
     */
    public function publish(KataEvent $event)
    {
        $this->guardAgainstNotLoadedEnvironment();

        $this->publisher->publish($event);
    }

    /**
     * @param KataExtension $extension
     */
    public function registerExtension(KataExtension $extension)
    {
        $extension->registerListeners($this);
    }

    /**
     * @param string $eventClass
     * @param callable $callable
     * @param int $priority
     */
    public function addListener($eventClass, $callable, $priority = 0)
    {
        $this->publisher->addListener($eventClass, $callable, $priority);
    }

    /**
     * @param EnvironmentVisitor $visitor
     */
    public function acceptEnvironmentVisitor(EnvironmentVisitor $visitor)
    {
        $visitor->visitSourceFolder($this->sourceFolder);
    }

    /**
     * @return bool
     */
    private function isLoaded()
    {
        return $this->publisher instanceof EventPublisher;
    }

    private function guardAgainstNotLoadedEnvironment()
    {
        if (! $this->isLoaded()) {
            throw EnvironmentException::environmentNotLoaded();
        }
    }

    /**
     * @param string $basePath
     * @param string $srcPath
     *
     * @return FilesystemEnvironment
     */
    public static function setup($basePath, $srcPath = 'src')
    {
        $fullPath = $basePath . DIRECTORY_SEPARATOR . $srcPath;
        if (! file_exists($fullPath)) {
            mkdir($fullPath);
        }

        return new self($basePath, $srcPath);
    }
}
