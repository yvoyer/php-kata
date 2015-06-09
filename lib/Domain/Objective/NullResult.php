<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Objective;

use Star\Fixture\Null\NullObjective;

/**
 * Class NullResult
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Objective
 */
final class NullResult implements ObjectiveResult
{
    /**
     * @return int
     */
    public function points()
    {
        return 0;
    }

    /**
     * @return int
     */
    public function maxPoints()
    {
        return 0;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return true;
    }

    /**
     * @return Objective
     */
    public function objective()
    {
        return new NullObjective();
    }

    /**
     * @param string $requirement
     */
    public function failRequirement($requirement)
    {
    }
}
