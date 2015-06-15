<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\View;

use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\StartedKata;

/**
 * Class ResultRenderer
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\View
 */
interface ResultRenderer
{
    /**
     * @param ObjectiveResult $result
     */
    public function displaySuccess(ObjectiveResult $result);

    /**
     * @param ObjectiveResult $result
     */
    public function displayFailure(ObjectiveResult $result);

    /**
     * @param Objective $objective
     */
    public function displayObjective(Objective $objective);

    /**
     * @param \Exception $exception
     */
    public function displayError(\Exception $exception);

    /**
     * @param StartedKata $kata
     */
    public function displayKata(StartedKata $kata);
}
