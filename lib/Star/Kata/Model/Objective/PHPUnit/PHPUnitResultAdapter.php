<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective\PHPUnit;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite;
use Star\Kata\Model\Objective\ObjectiveResult;

/**
 * Class PHPUnitResultAdapter
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective\PHPUnit
 */
final class PHPUnitResultAdapter implements \PHPUnit_Framework_TestListener
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
        $this->result = $result;
    }

    /**
     * An error occurred.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception $e
     * @param float $time
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->result->failRequirement($e->getMessage());
    }

    /**
     * A failure occurred.
     *
     * @param PHPUnit_Framework_Test $test
     * @param PHPUnit_Framework_AssertionFailedError $e
     * @param float $time
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        $this->result->failRequirement($e->getMessage());
    }

    /**
     * Incomplete test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception $e
     * @param float $time
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->result->failRequirement($e->getMessage());
    }

    /**
     * Risky test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception $e
     * @param float $time
     * @since  Method available since Release 4.0.0
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->result->failRequirement($e->getMessage());
    }

    /**
     * Skipped test.
     *
     * @param PHPUnit_Framework_Test $test
     * @param Exception $e
     * @param float $time
     * @since  Method available since Release 3.0.0
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
        $this->result->failRequirement($e->getMessage());
    }

    /**
     * A test suite started.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     * @since  Method available since Release 2.2.0
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * A test suite ended.
     *
     * @param PHPUnit_Framework_TestSuite $suite
     * @since  Method available since Release 2.2.0
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * A test started.
     *
     * @param PHPUnit_Framework_Test $test
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
    }

    /**
     * A test ended.
     *
     * @param PHPUnit_Framework_Test $test
     * @param float $time
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
    }
}
