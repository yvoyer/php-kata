<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\AssertFalse;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\StartedKata;

/**
 * Class AssertFalseKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\UserInputInvalidCode
 */
final class AssertFalseKata implements Kata
{
    /**
     * @return Objective
     */
    public function createObjective()
    {
        return new AssertFalseObjective();
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
     *
     * todo Remove Environment from start.
     */
    public function start(Environment $environment)
    {
        $environment->generateClass('AssertFalse');

        return new StartedKata($this, $this->createObjective());
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'assert-false';
    }
}
