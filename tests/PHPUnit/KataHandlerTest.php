<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit;

use Star\Kata\Data\Fibonacci\FibonacciKata;
use Star\Kata\KataRunner;

/**
 * Class KataHandlerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit
 */
final class KataHandlerTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var KataRunner
     */
    private $handler;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    public function setUp()
    {
        $this->handler = new KataRunner();
        $this->kata = $this->getMockKata();
    }

    public function test_it_should_return_the_errors()
    {
        // todo use mock
        $result = $this->handler->run(new FibonacciKata());
        $this->assertTrue($result->isFailure());
    }
}
