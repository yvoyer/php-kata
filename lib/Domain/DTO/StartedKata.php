<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\DTO;

use Star\Kata\Domain\Kata;
use Star\Kata\Domain\Objective\Objective;

/**
 * @author  Yannick Voyer (http://github.com/yvoyer)
 */
class StartedKata
{
    /**
     * @var Kata
     */
    private $wrappedKata;

    /**
     * @var Objective
     */
    private $objective;

    /**
     * @param Kata $kata
     * @param Objective $objective
     */
    public function __construct(Kata $kata, Objective $objective)
    {
        $this->wrappedKata = $kata;
        $this->objective = $objective;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->wrappedKata->name();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->objective->description();
    }
}
