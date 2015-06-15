<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class PHPUnitObjectiveResult
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\ObjectiveTestCase
 */
interface ObjectiveResult
{
    /**
     * @return int
     */
    public function points();

    /**
     * @return int
     */
    public function maxPoints();

    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return bool
     */
    public function isFailure();

    /**
     * @return Objective
     */
    public function objective();

    /**
     * @param string $requirement
     */
    public function failRequirement($requirement);
}
