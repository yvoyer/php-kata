<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Builder;

use Star\Kata\Model\Objective\ConfigurableObjective;
use Star\Kata\Model\Objective\Objective;

/**
 * Class ObjectiveBuilder
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Builder
 */
final class ObjectiveBuilder
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var int
     */
    private $count = 1;

    public function __construct()
    {
        $this->resetData();
    }

    /**
     * @return Objective
     */
    public function build()
    {
        $objective = new ConfigurableObjective($this->data['description'], $this->data['code']);
        $this->resetData();

        return $objective;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function withDescription($description)
    {
        $this->data['description'] = $description;

        return $this;
    }

    /**
     * @param callable $assertCode
     *
     * @return $this
     */
    public function withAssertCode(\Closure $assertCode)
    {
        $this->data['code'] = $assertCode;

        return $this;
    }

    private function resetData()
    {
        $this->data = array();
        $this->withDescription('Objective ' . $this->count ++);
        $this->withAssertCode(function() {
            throw new \RuntimeException('The assertion code should be configured.');
        });
    }
}
