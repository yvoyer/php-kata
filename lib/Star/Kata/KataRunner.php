<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Model\Kata;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\PHPUnit\KataTestRunner;

/**
 * Class KataRunner
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata
 */
final class KataRunner
{
    /**
     * @param Kata $kata
     *
     * @return ObjectiveResult
     */
    public function run(Kata $kata)
    {
        $objective = $kata->createObjective();

        return KataTestRunner::execute($objective);
    }
}
