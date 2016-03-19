<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Symfony\Event;

use Star\Kata\Domain\Event\EventException;
use Star\Kata\Domain\Event\EventPublisher;
use Star\Kata\Domain\Event\KataEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class SymfonyDispatcherPublisher implements EventPublisher
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    public function __construct()
    {
        $this->dispatcher = new EventDispatcher();
    }

    /**
     * @param KataEvent|string $eventClass The event (class name) to register
     * @param callable $listener The callable that listens to the event
     * @param int $priority
     * @throws \Star\Kata\Domain\Event\PublisherException
     */
    public function addListener($eventClass, $listener, $priority = 0)
    {
        $reflection = new \ReflectionClass($eventClass);
        if (! $reflection->isSubclassOf(KataEvent::class)) {
            throw EventException::eventClassIsNotInstanceOfKataEvent($eventClass);
        }

        $eventName = $eventClass::getIdentifier();
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * @param KataEvent $event
     */
    public function publish(KataEvent $event)
    {
        $this->dispatcher->dispatch($event->getIdentifier(), $event);
    }
}
