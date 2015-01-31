<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Exception\RuntimeException;
use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\TestObjective;
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
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $srcPath;

    /**
     * @var TypedCollection|Objective[]
     */
    private $objectives;

    /**
     * @param string $srcPath
     * @param string $name
     *
     * @throws \Star\Kata\Exception\RuntimeException
     */
    public function __construct($srcPath, $name = '')
    {
        $this->name = $name;
        $this->steps = new TypedCollection(Step::INTERFACE_NAME);
        $this->objectives = new TypedCollection(Objective::OBJECTIVE_NAME);
        $this->srcPath = $srcPath;

        $this->configure();
        if (empty($this->name)) {
            throw new RuntimeException('Name should be configured.');
        }
    }

    /**
     * Configure the kata.
     */
    protected function configure()
    {
    }

    private function isInitialized()
    {
        foreach ($this->steps as $step) {
            if (! $step->isInitialized()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return StartedKata
     * @throws \Star\Kata\Exception\RuntimeException
     */
    public function start()
    {
        if ($this->steps->isEmpty()) {
            throw new RuntimeException('Should have at least one step');
        }

        if ($this->isInitialized()) {
            throw new RuntimeException('The kata is already initialized.');
        }

        foreach ($this->steps as $step) {
            $step->init();
        }

        return new StartedKata($this);
    }

    /**
     * @return Objective\ObjectiveResult
     */
    public function end()
    {
//        if ($this->steps->isEmpty()) {
//            throw new RuntimeException('Should have at least one step');
//        }
        // todo check that the kata is initialized
        $class = '\FibonacciSequenceTest';
        $objective = new TestObjective('', new $class());

//        $suite = new \PHPUnit_Framework_TestSuite();
//        foreach ($this->steps as $step) {
//            $class = $step->getTestClass();
//            $case = $step->getTestCase();
//
//            $suite->addTest(new $class($case));
//        }
//        $result = $suite->run();

        return $objective->validate();
    }

    /**
     * @param Step $step
     */
    public function addStep(Step $step)
    {
        $this->steps->add($step);
    }

    /**
     * @param Objective $objective
     */
    public function addObjective(Objective $objective)
    {
        $this->objectives->add($objective);
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the description.
     *
     * @param string $description
     */
    protected function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    protected function getSrcPath()
    {
        return $this->srcPath;
    }
}
