<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Objective;

/**
 * Class PHPUnitObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\PHPUnitObjective
 */
interface Objective
{
    /**
     * @return int
     */
    public function getMaximumPoints();

    /**
     * @return ObjectiveResult
     */
    public function createResult();

    /**
     * @return string
     */
    public function description();
}
