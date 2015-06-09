<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\PHPUnit;

use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Infrastructure\PHPUnit\Runner\PHPUnitTestRunner;

/**
 * Class PHPUnitKataRunner
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\PHPUnit
 */
final class PHPUnitKataRunner implements KataRunner
{
    /**
     * @param Kata $kata
     *
     * @return ObjectiveResult
     */
    public function run(Kata $kata)
    {
        $objective = $kata->createObjective();

        return PHPUnitTestRunner::execute($objective);
    }
}
