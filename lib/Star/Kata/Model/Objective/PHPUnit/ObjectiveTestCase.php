<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective\PHPUnit;

use Star\Kata\Model\Objective\ObjectiveResult;
use \Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\StandardResult;

/**
 * Class ObjectiveTestCase
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective\PHPUnit
 */
abstract class ObjectiveTestCase extends \PHPUnit_Framework_TestCase implements Objective
{
    /**
     * @return int
     */
    public function getMaximumPoints()
    {
        $methods = get_class_methods($this);
        $testMethods = array_filter(
            $methods,
            function($methodName) {
                return 0 === strpos($methodName, 'test');
            }
        );

        return count($testMethods); // 1 point per passing test case (implements a strategy one day ?
    }

    /**
     * @return ObjectiveResult
     */
    public function createResult()
    {
        return new StandardResult($this->getMaximumPoints(), $this);
    }
}
