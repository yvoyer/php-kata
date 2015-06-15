<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Data\Fibonacci;

use Star\Kata\Generator\ClassGenerator;
use Star\Kata\KataRunner;
use Star\Kata\Model\Kata;
use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\StartedKata;

/**
 * Class FibonacciKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Data\Fibonacci
 */
final class FibonacciKata implements Kata
{
    /**
     * @return Objective
     */
    public function createObjective()
    {
        return new FibonacciTest();
    }

    /**
     * @param KataRunner $handler
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $handler)
    {
        return $handler->run($this);
    }

    /**
     * Define pre-conditions to use kata.
     *
     * @param ClassGenerator $generator
     *
     * @return StartedKata
     */
    public function start(ClassGenerator $generator)
    {
        return new StartedKata($this, $this->createObjective());
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'fibonacci';
    }
}
