<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Exception\RuntimeKataException;
use Star\Kata\Generator\ClassGenerator;
use Star\Kata\KataRunner;
use Star\Kata\Model\Objective\NotImplementedObjective;
use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\Step\Step;

/**
 * Class Kata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 *
 * @deprecated todo Remove
 */
class LegacyKata implements Kata
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
    private $srcPath;

    private function __construct()
    {
        $this->steps = new TypedCollection(Step::INTERFACE_NAME);
//        $this->configure();
    }

    /**
     * @param $srcPath
     * @param string $name
     *
     * @return Kata
     * @throws \Star\Kata\Exception\RuntimeKataException
     */
    public static function fromLegacy($srcPath, $name = '')
    {
        /**
         * @var self $kata
         */
        $kata = new static();
        $kata->srcPath = $srcPath;
        $kata->setName($name);
        $kata->configure();
        if (0 == strlen($kata->name())) {
            throw new RuntimeKataException('Name should be configured.');
        }

        return $kata;
    }

    /**
     * Configure the kata.
     * @deprecated Still usefull?
     */
    protected function configure()
    {
    }

    /**
     * @param Environment $environment
     * @return StartedKata
     */
    public function start(Environment $environment)
    {
        return new StartedKata($this, $this->createObjective());
    }

    /**
     * @return Objective
     * @deprecated
     */
    public function end()
    {
        return $this->evaluate(new KataRunner());
//        if ($this->steps->isEmpty()) {
//            throw new RuntimeKataException('Should have at least one step');
//        }
        // todo check that the kata is initialized
//        $class = '\FibonacciSequenceTest';
//        $objective = new TestObjective('', new $class());

//        $suite = new \PHPUnit_Framework_TestSuite();
//        foreach ($this->steps as $step) {
//            $class = $step->getTestClass();
//            $case = $step->getTestCase();
//
//            $suite->addTest(new $class($case));
//        }
//        $result = $suite->run();

//        return $objective->validate();
    }

    /**
     * @param Step $step
     * @deprecated
     */
    public function addStep(Step $step)
    {
        $this->steps->add($step);
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Objective
     */
    public function createObjective()
    {
        return new NotImplementedObjective();
    }

    /**
     * @param KataRunner $handler
     *
     * @return ObjectiveResult
     */
    public function evaluate(KataRunner $handler)
    {
        return $handler->run($this);//throw new \RuntimeKataException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }
}
