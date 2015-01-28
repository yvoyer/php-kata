<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Model;

use Star\Kata\Model\Kata;
use Star\Kata\Model\StartedKata;
use Star\Kata\Model\Step\Step;

/**
 * Class KataTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit\Model
 *
 * @covers Star\Kata\Model\Kata
 * @uses Star\Kata\Model\StartedKata
 */
final class KataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Kata
     */
    private $kata;

    public function setUp()
    {
        $this->kata = new Kata('path', 'name');
    }

    public function test_get_name_should_return_the_name()
    {
        $this->assertSame('name', $this->kata->getName());
    }

    public function test_start_should_return_started_kata()
    {
        $this->kata->addStep($this->getMock(Step::INTERFACE_NAME));
        $this->assertInstanceOf(StartedKata::CLASS_NAME, $this->kata->start());
    }
}
