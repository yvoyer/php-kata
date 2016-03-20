<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Event;

use Star\Kata\Domain\DTO\StartedKata;

/**
 * @author  Yannick Voyer (http://github.com/yvoyer)
 */
final class KataWasStarted extends KataEvent
{
    const EVENT_NAME = 'core.kata_started';

    /**
     * @var StartedKata
     */
    private $kata;

    public function __construct(StartedKata $kata)
    {
        $this->kata = $kata;
    }

    /**
     * @return string
     */
    public function kata()
    {
        return $this->kata->getName();
    }
}
