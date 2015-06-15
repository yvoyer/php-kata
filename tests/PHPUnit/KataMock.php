<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit;

/**
 * Class KataMock
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit
 */
trait KataMock
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockEnvironment()
    {
        return $this->getMock('Star\Kata\Model\Environment');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKata()
    {
        return $this->getMock('Star\Kata\Model\Kata');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataRepository()
    {
        return $this->getMock('Star\Kata\Model\KataRepository');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockObjective()
    {
        return $this->getMock('Star\Kata\Model\Objective\Objective');
    }
}
