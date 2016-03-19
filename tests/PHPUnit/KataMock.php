<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Domain\DTO\StartedKata;
use Star\Kata\Domain\Environment;
use Star\Kata\Domain\Event\EventPublisher;
use Star\Kata\Domain\Event\KataEvent;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRepository;
use Star\Kata\Domain\KataRunner;
use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;

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
        return $this->getMock(Environment::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKata()
    {
        return $this->getMock(Kata::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockStartedKata()
    {
        return $this->getMockBuilder(StartedKata::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataEvent()
    {
        return $this->getMock(KataEvent::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataEventPublisher()
    {
        return $this->getMock(EventPublisher::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataRepository()
    {
        return $this->getMock(KataRepository::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockKataRunner()
    {
        return $this->getMock(KataRunner::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockObjective()
    {
        return $this->getMock(Objective::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockObjectiveResult()
    {
        return $this->getMock(ObjectiveResult::class);
    }
}
