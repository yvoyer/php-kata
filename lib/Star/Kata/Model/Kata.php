<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Kata\KataRunner;
use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
interface Kata
{
    /**
     * @return Objective
     */
    public function createObjective();

    /**
     * @param KataRunner $handler
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $handler);

    /**
     * Define pre-conditions to use kata.
     *
     * @param Environment $environment
     *
     * @return StartedKata
     */
    public function start(Environment $environment);

    /**
     * @return string
     */
    public function name();
}
