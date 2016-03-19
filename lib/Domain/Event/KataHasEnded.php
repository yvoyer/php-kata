<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

final class KataHasEnded extends KataEvent
{
    const EVENT_NAME = 'core.kata_ended';

    /**
     * @var string
     */
    private $kata;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->kata = $name;
    }

    /**
     * @return string
     */
    public function kata()
    {
        return $this->kata;
    }
}
