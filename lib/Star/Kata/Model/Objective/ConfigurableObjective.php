<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model\Objective;

/**
 * Class ConfigurableObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model\Objective
 */
final class ConfigurableObjective implements Objective
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var \Closure
     */
    private $assertCode;

    /**
     * @param string   $description
     * @param callable $assertCode
     */
    public function __construct($description, \Closure $assertCode)
    {
        $this->description = $description;
        $this->assertCode = $assertCode;
    }

    /**
     * Validate the Objective.
     *
     * @return ObjectiveResult
     */
    public function validate()
    {
        $closure = $this->assertCode;
        $closure();
    }

    /**
     * The name of the objective.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
