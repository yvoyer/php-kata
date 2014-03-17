<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Exception\RuntimeException;
use Star\Kata\Model\Step\Step;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
class Kata
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var Step[]|TypedCollection
     */
    private $steps;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->steps = new TypedCollection(Step::INTERFACE_NAME);
    }

    /**
     * @return bool
     * @throws \Star\Kata\Exception\RuntimeException
     */
    public function start()
    {
        if ($this->steps->isEmpty()) {
            throw new RuntimeException('Should have at least one step');
        }

        foreach ($this->steps as $step) {
            $step->init();
        }

        return true;
    }

    /**
     * @param Step $step
     */
    public function addStep(Step $step)
    {
        $this->steps->add($step);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
