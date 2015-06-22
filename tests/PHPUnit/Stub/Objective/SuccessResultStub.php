<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Stub\Objective;

use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;

/**
 * Class SuccessResultStub
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Stub\Objective
 */
final class SuccessResultStub implements ObjectiveResult
{
    /**
     * @return int
     */
    public function points()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function maxPoints()
    {
        return 1;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isFailure()
    {
        return false;
    }

    /**
     * @return Objective
     */
    public function objective()
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * @param string $requirement
     */
    public function failRequirement($requirement)
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
