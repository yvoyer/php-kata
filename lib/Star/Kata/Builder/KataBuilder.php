<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Builder;

use Star\Kata\Model\Kata;
use Star\Kata\Model\Objective\Objective;

/**
 * Class KataBuilder
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Builder
 */
final class KataBuilder
{
    /**
     * @var ObjectiveBuilder
     */
    private $objectiveBuilder;

    /**
     * @var array
     */
    private $data;

    /**
     * @var Objective[]
     */
    private $objectives = array();

    /**
     * @var int
     */
    private $count = 1;

    public function __construct()
    {
        $this->resetData();
        $this->objectiveBuilder = new ObjectiveBuilder();
    }

    /**
     * @return Kata
     */
    public function build()
    {
        $this->count ++;
        // todo define path in builder construct?
        $kata = new Kata('path', $this->data['name']);
        foreach ($this->objectives as $objective) {
            $kata->addObjective($objective);
        }

        $this->resetData();

        return $kata;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function withName($name)
    {
        $this->data['name'] = $name;

        return $this;
    }

    /**
     * @param string   $description
     * @param callable $assert
     *
     * @return $this
     */
    public function withObjective($description, \Closure $assert)
    {
        $this->objectives[] = $this->objectiveBuilder
            ->withDescription($description)
            ->withAssertCode($assert)
            ->build();

        return $this;
    }

    private function resetData()
    {
        $this->objectives = array();
        $this->data = array();
        $this->withName('kata-' . $this->count);
    }
}
