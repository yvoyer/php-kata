<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Kata\Exception\MissingConfigurationException;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
class Kata
{
    /**
     * @var Step[]
     */
    private $steps = array();

    /**
     * @return bool
     * @throws \Star\Kata\Exception\MissingConfigurationException
     */
    public function start()
    {
        if (count($this->steps) == 0) {
            throw new MissingConfigurationException('Should have at least one step');
        }

        foreach ($this->steps as $step) {
            $step->setup();
        }

        return true;
    }

    public function addStep(Step $step)
    {
        $this->steps[] = $step;
    }
}
 