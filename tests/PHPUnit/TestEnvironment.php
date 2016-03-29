<?php

namespace Star\Kata;

use org\bovigo\vfs\vfsStream;
use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Event\EventPublisher;
use Star\Kata\Domain\Event\KataEvent;
use Star\Kata\Domain\Exception\CurrentKataException;
use Star\Kata\Domain\Extension\KataExtension;
use Star\Kata\Domain\Visitor\EnvironmentVisitor;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;

final class TestEnvironment implements Environment
{
    /**
     * @var FilesystemEnvironment
     */
    private $environment;

    public function __construct()
    {
        $root = vfsStream::setup('root', null, ['src' => []]);
        $this->environment = new FilesystemEnvironment($root->url(), 'src');
    }

    /**
     * @param string $className
     */
    public function generateClass($className)
    {
        return $this->environment->generateClass($className);
    }

    /**
     * @param string $name
     * @param array $args
     */
    public function generateMethod($name, array $args = array())
    {
        return $this->environment->generateMethod($name, $args);
    }

    /**
     * Check if the environment already contains data.
     *
     * @return bool
     */
    public function isClean()
    {
        return $this->environment->isClean();
    }

    public function clear()
    {
        return $this->environment->clear();
    }

    /**
     * @param EventPublisher $publisher todo move to configuration
     *
     * @deprecated todo find better API
     */
    public function setPublisher(EventPublisher $publisher)
    {
        return $this->environment->setPublisher($publisher);
    }

    /**
     * @param KataExtension $extension
     */
    public function registerExtension(KataExtension $extension)
    {
        return $this->environment->registerExtension($extension);
    }

    /**
     * Return the current kata.
     *
     * @return string The name of the kata.
     * @throws CurrentKataException When no current defined
     */
    public function currentKata()
    {
        return $this->environment->currentKata();
    }

    /**
     * @param KataEvent $event
     */
    public function publish(KataEvent $event)
    {
        return $this->environment->publish($event);
    }

    /**
     * @param string $eventClass
     * @param callable $callable
     * @param int $priority
     */
    public function addListener($eventClass, $callable, $priority = 0)
    {
        return $this->environment->addListener($eventClass, $callable, $priority);
    }

    /**
     * @param EnvironmentVisitor $visitor
     */
    public function acceptEnvironmentVisitor(EnvironmentVisitor $visitor)
    {
        return $this->environment->acceptEnvironmentVisitor($visitor);
    }
}
