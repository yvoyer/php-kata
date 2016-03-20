<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

use Symfony\Component\EventDispatcher\Event;

abstract class KataEvent extends Event
{
    /**
     * @throws EventException
     * @return string
     */
    public static function getIdentifier()
    {
        $reflection = new \ReflectionClass(static::class);
        if (! $reflection->hasConstant('EVENT_NAME')) {
            throw EventException::noIdentifierConstantFound(static::class);
        }

        return static::EVENT_NAME;
    }
}
