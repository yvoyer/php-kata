<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\PHPUnit;

use Star\Kata\Data\Fibonacci\FibonacciKata;
use Star\Kata\KataMock;

/**
 * Class PHPUnitKataRunnerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\PHPUnit
 */
final class PHPUnitKataRunnerTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var PHPUnitKataRunner
     */
    private $handler;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    public function setUp()
    {
        $this->handler = new PHPUnitKataRunner();
        $this->kata = $this->getMockKata();
    }

    public function test_it_should_return_the_errors()
    {
        // todo use mock
        $result = $this->handler->run(new FibonacciKata());
        $this->assertTrue($result->isFailure());
    }
}
