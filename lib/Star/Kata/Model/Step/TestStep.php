<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Step;

/**
 * Class TestStep
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Step
 */
class TestStep implements Step
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $testCase;

    /**
     * @param string $class
     * @param string $testCase
     */
    public function __construct($class, $testCase)
    {
        $this->class = $class;
        $this->testCase = $testCase;
    }

    /**
     * Initialize the step.
     */
    public function init()
    {
    }

    /**
     * Returns the Class.
     *
     * @return string
     */
    public function getTestClass()
    {
        return $this->class;
    }

    /**
     * Returns the TestCase.
     *
     * @return string
     */
    public function getTestCase()
    {
        return $this->testCase;
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        // todo
        return true;
    }
}
 