<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class ObjectiveResult
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective
 */
class ObjectiveResult
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var integer
     */
    private $points = 0;

    /**
     * @var integer
     */
    private $maxPoints;

    /**
     * @param integer $points
     */
    public function __construct($points)
    {
        $this->maxPoints = $points;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->maxPoints - $this->points;
    }

    /**
     * @param integer $count
     */
    public function addFailure($count)
    {
        $this->points += $count;

        if ($this->points >= $this->maxPoints) {
            $this->points = $this->maxPoints;
        }
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getPoints() == $this->maxPoints;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return !$this->isSuccess();
    }
}
