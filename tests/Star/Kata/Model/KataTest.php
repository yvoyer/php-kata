<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\Star\Kata\Model;

use Star\Kata\Model\Kata;

/**
 * Class KataTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\Star\Kata\Model
 */
class KataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Kata
     */
    private $kata;

    public function setUp()
    {
        $this->kata = new Kata();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockStep()
    {
        return $this->getMock('Star\Kata\Model\Step', array('setup'));
    }

    public function testShouldReturnTrueWhenCorrectlyStarted()
    {
        $this->kata->addStep($this->getMockStep());
        $this->assertTrue($this->kata->start());
    }

    public function testShouldSetupTheFirstStepOnStart()
    {
        $step = $this->getMockStep();
        $step
            ->expects($this->once())
            ->method('setup');

        $this->kata->addStep($step);
        $this->kata->start();
    }

    /**
     * @expectedException \Star\Kata\Exception\MissingConfigurationException
     */
    public function testShouldThrowExceptionWhenNoStepAreConfigured()
    {
        $this->kata->start();
    }
}
 