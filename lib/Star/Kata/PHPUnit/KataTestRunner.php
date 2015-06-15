<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\PHPUnit;

use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\Objective\PHPUnit\PHPUnitResultAdapter;

/**
 * Class KataTestRunner
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\PHPUnit
 */
final class KataTestRunner extends \PHPUnit_TextUI_TestRunner
{
    /**
     * @var ObjectiveResult
     */
    private $result;

    /**
     * @param ObjectiveResult $result
     */
    public function __construct(ObjectiveResult $result)
    {
        parent::__construct();

        $this->result = $result;
    }

    /**
     * @return \PHPUnit_Framework_TestResult
     */
    protected function createTestResult()
    {
        $result = new \PHPUnit_Framework_TestResult();
        $result->addListener(new PHPUnitResultAdapter($this->result));
        $result->addListener(new \PHPUnit_Util_TestDox_ResultPrinter_Text());

        return $result;
    }

    /**
     * @param  Objective $objective
     * @return ObjectiveResult
     */
    public static function execute(Objective $objective)
    {
        $suite = new \PHPUnit_Framework_TestSuite(get_class($objective));

        $result = $objective->createResult();

        $runner = new self($result);
        $runner->setPrinter(new NullPrinter());
        $runner->doRun($suite, array());

        return $result;
    }
}
