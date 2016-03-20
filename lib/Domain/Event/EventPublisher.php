<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

interface EventPublisher
{
    /**
     * @param KataEvent|string $eventClass The event (class name) to register
     * @param callable $listener The callable that listens to the event
     * @param int $priority
     * @throws \Star\Kata\Domain\Event\PublisherException
     */
    public function addListener($eventClass, $listener, $priority = 0);

    /**
     * @param KataEvent $event
     */
    public function publish(KataEvent $event);
}
