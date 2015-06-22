<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Runner;

use Psr\Log\LoggerInterface;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\Objective\ObjectiveResult;

/**
 * Class LoggableRunner
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Runner
 */
final class LoggableRunner implements KataRunner
{
    /**
     * @var KataRunner
     */
    private $runner;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param KataRunner $runner
     * @param LoggerInterface $logger todo use adapter to kata package interface
     */
    public function __construct(KataRunner $runner, LoggerInterface $logger)
    {
        $this->runner = $runner;
        $this->logger = $logger;
    }

    /**
     * @param Kata $kata
     *
     * @return ObjectiveResult
     */
    public function run(Kata $kata)
    {
        $result = $this->runner->run($kata);
        if ($result->isFailure()) {
            $this->logger->error('KATA has failed (use renderer)');
        } elseif ($result->isSuccess()) {
            $this->logger->info('KATA has succeed (use renderer)');
        }

        return $result;
    }
}
