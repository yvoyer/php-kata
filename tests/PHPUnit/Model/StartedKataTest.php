<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Model;

use Star\Kata\Model\Kata;
use Star\Kata\Model\StartedKata;

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
    /**
     * @var StartedKata
     */
    private $kata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedKata;

    public function setUp()
    {
        $this->wrappedKata = $this->getMockBuilder(Kata::CLASS_NAME)
            ->disableOriginalConstructor()
            ->getMock();

        $this->kata = new StartedKata($this->wrappedKata);
    }

    public function test_should_return_the_name()
    {
        $this->wrappedKata
            ->expects($this->once())
            ->method('getName')
            ->willReturn('name');

        $this->assertSame('name', $this->kata->getName());
    }

    public function test_should_return_the_description()
    {
        $this->wrappedKata
            ->expects($this->once())
            ->method('getDescription')
            ->willReturn('desc');

        $this->assertSame('desc', $this->kata->getDescription());
    }
}
