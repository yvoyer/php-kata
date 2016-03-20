<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

use Star\Kata\Domain\Exception\KataException;

final class EventException extends \Exception implements KataException
{
    /**
     * @param string $eventName
     *
     * @return EventException
     */
    public static function noIdentifierConstantFound($eventName)
    {
        return new self("The event '{$eventName}' do not have a EVENT_NAME constant, define one with a unique name.'");
    }

    /**
     * @param string $eventClass
     *
     * @return PublisherException
     */
    public static function eventClassIsNotInstanceOfKataEvent($eventClass)
    {
        return new self("The event '{$eventClass}' is not an instance of KataEvent.");
    }
}
