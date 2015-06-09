<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\AssertTrue;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\StartedKata;

/**
 * Class AssertTrueKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\AssertTrue
 */
final class AssertTrueKata implements Kata
{
    /**
     * @return Objective
     */
    public function createObjective()
    {
        return new AssertTrueObjective();
    }

    /**
     * @param KataRunner $runner
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $runner)
    {
        return $runner->run($this);
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
        $environment->generateClass('AssertTrue');

        return new StartedKata($this, $this->createObjective());
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'assert-true';
    }
}
