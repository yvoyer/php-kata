<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class NullObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective
 */
final class NullObjective implements Objective
{
    /**
     * Validate the Objective.
     *
     * @return ObjectiveResult
     */
    public function validate()
    {
        return new ObjectiveResult(0);
    }

    /**
     * The name of the objective.
     *
     * @return string
     */
    public function getName()
    {
        return 'null-objective';
    }
}
