<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Runner;

use Star\Kata\KataMock;
use Star\Kata\Stub\Objective\FailureResultStub;
use Star\Kata\Stub\Objective\SuccessResultStub;

/**
 * Class LoggableRunnerTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Runner
 */
final class LoggableRunnerTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var LoggableRunner
     */
    private $runner;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $wrappedRunner;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $logger;

    public function setUp()
    {
        $this->logger = $this->getMock('Psr\Log\LoggerInterface');
        $this->kata = $this->getMockKata();
        $this->wrappedRunner = $this->getMockKataRunner();

        $this->runner = new LoggableRunner($this->wrappedRunner, $this->logger);
    }

    public function test_it_should_log_the_success()
    {
        $result = new SuccessResultStub();
        $this->wrappedRunner
            ->expects($this->once())
            ->method('run')
            ->willReturn($result);

        $this->logger
            ->expects($this->once())
            ->method('info');

        $this->assertSame($result, $this->runner->run($this->kata));
    }

    public function test_it_should_the_failures()
    {
        $result = new FailureResultStub();
        $this->wrappedRunner
            ->expects($this->once())
            ->method('run')
            ->willReturn($result);

        $this->logger
            ->expects($this->once())
            ->method('error');

        $this->assertSame($result, $this->runner->run($this->kata));
    }
}
