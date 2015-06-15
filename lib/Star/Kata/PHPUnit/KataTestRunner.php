<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\PHPUnit;

use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;

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
     * @var \PHPUnit_Framework_TestListener
     */
    private $listener;

    /**
     * @param \PHPUnit_Framework_TestListener $listener
     */
    public function __construct(\PHPUnit_Framework_TestListener $listener)
    {
        parent::__construct();

        $this->listener = $listener;
    }

    /**
     * @return \PHPUnit_Framework_TestResult
     */
    protected function createTestResult()
    {
        $result = new \PHPUnit_Framework_TestResult();
        $result->addListener($this->listener);

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
