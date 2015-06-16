<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Objective;

/**
 * Class StandardResult
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Objective
 */
final class StandardResult implements ObjectiveResult
{
    /**
     * @var integer
     */
    private $points;

    /**
     * @var integer
     */
    private $maxPoints;

    /**
     * @var Objective
     */
    private $objective;

    /**
     * @param int $maxPoints
     * @param Objective $objective
     */
    public function __construct($maxPoints, Objective $objective)
    {
        $this->maxPoints = $maxPoints;
        $this->points = $maxPoints;
        $this->objective = $objective;
    }

    /**
     * @return int
     */
    public function points()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function maxPoints()
    {
        return $this->maxPoints;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->maxPoints == $this->points;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return ! $this->isSuccess();
    }

    /**
     * @return Objective
     */
    public function objective()
    {
        return $this->objective;
    }

    /**
     * @param string $requirement
     */
    public function failRequirement($requirement)
    {
        $this->deducePoint();
    }

    private function deducePoint()
    {
        $this->points --;
        if ($this->points < 0) {
            $this->points = 0;
        }
    }
}
