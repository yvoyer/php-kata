<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class TestCaseObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective
 */
class TestObjective implements Objective
{
    /**
     * @var \PHPUnit_Framework_Test
     */
    private $test;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @param \PHPUnit_Framework_Test $test
     */
    public function __construct($name, \PHPUnit_Framework_Test $test)
    {
        $this->name = $name;
        $this->test = $test;
    }

    /**
     * Validate the Objective.
     *
     * @return ObjectiveResult
     */
    public function validate()
    {
        $testResult = $this->test->run();
        $testResult->beStrictAboutTestsThatDoNotTestAnything(true);

        // Todo find whether the test has failing one
        var_dump($testResult->count(), $testResult->failureCount(), $testResult->wasSuccessful());
        $objectiveResult = new ObjectiveResult($testResult->count());
        $objectiveResult->addFailure($testResult->failureCount());

        return $objectiveResult;
    }

    /**
     * The name of the objective.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
