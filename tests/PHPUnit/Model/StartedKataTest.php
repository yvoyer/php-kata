<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Model;

use Star\Kata\Model\StartedKata;
use tests\PHPUnit\KataMock;

/**
 * Class StartedKataTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit\Model
 *
 * @covers Star\Kata\Model\StartedKata
 */
final class StartedKataTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var StartedKata
     */
    private $kata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedKata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedObjective;

    public function setUp()
    {
        $this->wrappedKata = $this->getMockKata();
        $this->wrappedObjective = $this->getMockObjective();

        $this->kata = new StartedKata($this->wrappedKata, $this->wrappedObjective);
    }

    public function test_should_return_the_name()
    {
        $this->wrappedKata
            ->expects($this->once())
            ->method('name')
            ->willReturn('name');

        $this->assertSame('name', $this->kata->getName());
    }

    public function test_should_return_the_description()
    {
        $this->wrappedObjective
            ->expects($this->once())
            ->method('description')
            ->willReturn('desc');

        $this->assertSame('desc', $this->kata->getDescription());
    }
}
