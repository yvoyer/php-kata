<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\DTO\StartedKata;
use Star\Kata\Domain\Event\KataHasEnded;
use Star\Kata\Domain\Event\KataWasStarted;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
abstract class Kata
{
    /**
     * @return Objective
     */
    public abstract function createObjective();

    /**
     * @param KataRunner $runner
     *
     * @return ObjectiveResult
     */
    protected abstract function evaluate(KataRunner $runner);

    /**
     * @param KataRunner $runner
     * @param Environment $environment
     *
     * @return ObjectiveResult
     */
    public function end(KataRunner $runner, Environment $environment)
    {
        $result = $this->evaluate($runner);
        $environment->publish(new KataHasEnded($this->name()));

        return $result;
    }

    /**
     * Define pre-conditions to use kata.
     *
     * @param Environment $environment
     *
     * @return StartedKata
     */
    protected abstract function setup(Environment $environment);

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
        $startedKata = $this->setup($environment);
        $environment->publish(new KataWasStarted($startedKata));

        return $startedKata;
    }

    /**
     * @return string
     */
    public abstract function name();
}
