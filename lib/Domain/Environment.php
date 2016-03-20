<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\Event\EventPublisher;
use Star\Kata\Domain\Event\KataEvent;
use Star\Kata\Domain\Exception\CurrentKataException;
use Star\Kata\Domain\Visitor\EnvironmentVisitor;
use Star\Kata\Domain\Extension\KataExtension;

/**
 * Class Environment
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
interface Environment
{
    /**
     * @param string $className
     */
    public function generateClass($className);

    /**
     * @param string $name
     * @param array $args
     */
    public function generateMethod($name, array $args = array());

    /**
     * Check if the environment already contains data.
     *
     * @return bool
     */
    public function isClean();

    public function clear();

    /**
     * @param EventPublisher $publisher todo move to configuration
     *
     * @deprecated todo find better API
     */
    public function setPublisher(EventPublisher $publisher);

    /**
     * @param KataExtension $extension
     */
    public function registerExtension(KataExtension $extension);

    /**
     * Return the current kata.
     *
     * @return string The name of the kata.
     * @throws CurrentKataException When no current defined
     */
    public function currentKata();

    /**
     * @param KataEvent $event
     */
    public function publish(KataEvent $event);

    /**
     * @param string $eventClass
     * @param callable $callable
     * @param int $priority
     */
    public function addListener($eventClass, $callable, $priority = 0);

    /**
     * @param EnvironmentVisitor $visitor
     */
    public function acceptEnvironmentVisitor(EnvironmentVisitor $visitor);
}
