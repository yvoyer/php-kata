<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\Symfony\Event;

use Star\Kata\Domain\Event\KataEvent;
use Star\Kata\KataMock;

final class SymfonyDispatcherPublisherTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SymfonyDispatcherPublisher
     */
    private $publisher;

    public function setUp()
    {
        $this->publisher = new SymfonyDispatcherPublisher();
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage Event was triggered: identifier
     */
    public function test_it_should_publish_the_event()
    {
        $closure = function (EventStub $stub) {
            throw new \RuntimeException('Event was triggered: ' . $stub::getIdentifier());
        };

        $this->publisher->addListener(EventStub::class, $closure);
        $this->publisher->publish(new EventStub());
    }

    /**
     * @expectedException        \Star\Kata\Domain\Event\EventException
     * @expectedExceptionMessage The event 'Star\Kata\Infrastructure\Symfony\Event\MissingConstantEvent' do not have a EVENT_NAME constant, define one with a unique name.
     */
    public function test_it_should_throw_exception_when_event_do_not_have_identifier()
    {
        $this->publisher->addListener(MissingConstantEvent::class, function() {});
    }

    /**
     * @expectedException        \Star\Kata\Domain\Event\EventException
     * @expectedExceptionMessage The event 'Star\Kata\Infrastructure\Symfony\Event\IsNotKataEvent' is not an instance of KataEvent.
     */
    public function test_it_should_throw_exception_when_event_is_not_kata_event()
    {
        $this->publisher->addListener(IsNotKataEvent::class, function() {});
    }
}

final class EventStub extends KataEvent
{
    const EVENT_NAME = 'identifier';
}

final class MissingConstantEvent extends KataEvent
{
}

final class IsNotKataEvent
{
    const EVENT_NAME = 'identifier';
}
