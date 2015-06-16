<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Data\Fibonacci;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\StartedKata;

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
     * @param Environment $environment
     *
     * @return StartedKata
     */
    public function start(Environment $environment)
    {
        $environment->generateClass('Fibonacci');

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
