<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Data;

use Star\Kata\Model\ClassTemplate;
use Star\Kata\Model\Kata;
use Star\Kata\Model\Step\TestStep;

/**
 * Class FibonacciKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Data
 */
class FibonacciKata extends Kata implements ClassTemplate
{
    public function __construct(/*Configuration $config*/)
    {
        parent::__construct('fibonacci');
        $this->addStep(new TestStep('\MyClassTest', 'testShouldReturnTrue'));
        $this->addStep(new TestStep('\MyClassTest', 'testShouldReturnFalse'));
        // todo create the test case
        // todo create the class under tests
//        $this->addStep(new CreateClassStep($config, $this));
//        $this->addStep(new CreateClassStep($config, $this));
    }

    /**
     * Return the name of the class to create.
     *
     * @return string
     */
    public function getClassName()
    {
//        throw new \RuntimeException('Method ' . __CLASS__ . '::getClassName() not implemented yet.');
    }

    /**
     * Return the content of the class definition.
     *
     * @return string
     */
    public function getContent()
    {
//        return '';
        throw new \RuntimeException('Method ' . __CLASS__ . '::getContent() not implemented yet.');
    }

    public function getDescription()
    {
        return <<<INFO

Fibonacci sequence
Objective: calculate the sum of the two previous numbers.

INFO;
    }
}
