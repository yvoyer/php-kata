<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Runner;

use Star\Kata\Domain\Kata;
use Star\Kata\Domain\Objective\ObjectiveResult;

/**
 * Class KataRunner
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Runner
 */
interface KataRunner
{
    /**
     * @param Kata $kata
     *
     * @return ObjectiveResult
     */
    public function run(Kata $kata);
}
