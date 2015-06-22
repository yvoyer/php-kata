<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\Null;

use Star\Kata\Domain\Objective\NullResult;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Infrastructure\PHPUnit\PHPUnitObjective;

/**
 * Class NullObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\Null
 */
final class NullObjective extends PHPUnitObjective
{
    /**
     * @return ObjectiveResult
     */
    public function createResult()
    {
        return new NullResult();
    }

    /**
     * @return string
     */
    public function description()
    {
        return 'Do nothing';
    }
}
