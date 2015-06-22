<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

/**
 * Class KataMock
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata
 */
trait KataMock
{
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockEnvironment()
    {
        return $this->getMock('Star\Kata\Domain\Environment');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKata()
    {
        return $this->getMock('Star\Kata\Domain\Kata');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataRepository()
    {
        return $this->getMock('Star\Kata\Domain\KataRepository');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataRunner()
    {
        return $this->getMock('Star\Kata\Domain\KataRunner');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockObjective()
    {
        return $this->getMock('Star\Kata\Domain\Objective\Objective');
    }
}
