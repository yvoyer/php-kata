<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\Event\KataWasStarted;
use Star\Kata\KataMock;

final class KataTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var Kata|\PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $startedKata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $environment;

    public function setUp()
    {
        $this->environment = $this->getMockEnvironment();
        $this->startedKata = $this->getMockStartedKata();
        $this->kata = $this->getMockForAbstractClass(Kata::class);
    }

    public function test_it_should_trigger_the_kata_was_started_event()
    {
        $this->kata
            ->method('setup')
            ->willReturn($this->startedKata);
        $this->environment
            ->expects($this->once())
            ->method('publish')
            ->with($this->isInstanceOf(KataWasStarted::class));

        $this->assertSame($this->startedKata, $this->kata->start($this->environment));
    }
}
