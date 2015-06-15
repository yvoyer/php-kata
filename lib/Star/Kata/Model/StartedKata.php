<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Kata\Model\Objective\Objective;

/**
 * Class StartedKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
final class StartedKata
{
    const CLASS_NAME = __CLASS__;

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
