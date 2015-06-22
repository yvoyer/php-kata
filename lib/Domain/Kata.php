<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\Runner\KataRunner;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
interface Kata
{
    /**
     * @return Objective
     */
    public function createObjective();

    /**
     * @param KataRunner $runner
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $runner);

    /**
     * Define pre-conditions to use kata.
     *
     * @param Environment $environment
     *
     * @return StartedKata
     *
     * todo Remove Environment from start.
     */
    public function start(Environment $environment);

    /**
     * @return string
     */
    public function name();
}
