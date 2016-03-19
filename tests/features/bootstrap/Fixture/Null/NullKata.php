<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\Null;

use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\NullResult;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\DTO\StartedKata;

/**
 * Class NullKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\Null
 */
final class NullKata extends Kata
{
    /**
     * @return Objective
     */
    public function createObjective()
    {
        return new NullObjective();
    }

    /**
     * @param KataRunner $runner
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $runner)
    {
        return new NullResult();
    }

    /**
     * Define pre-conditions to use kata.
     *
     * @param Environment $environment
     *
     * @return StartedKata
     */
    protected function setup(Environment $environment)
    {
        return new StartedKata($this, $this->createObjective());
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'null';
    }
}
