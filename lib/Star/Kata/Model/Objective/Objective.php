<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class Objective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective
 */
interface Objective
{
    const OBJECTIVE_NAME = __CLASS__;

    /**
     * Validate the Objective.
     *
     * @return ObjectiveResult
     */
    public function validate();

    /**
     * @return string
     */
    public function getDescription();
}
