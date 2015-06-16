<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\Exception\DirtyEnvironmentException;
use Star\Kata\Domain\Exception\EntityNotFoundException;
use Star\Kata\Domain\Exception\InvalidArgumentException;

/**
 * Class KataService
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
final class KataService
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var KataRepository
     */
    private $katas;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var KataRunner
     */
    private $runner;

    /**
     * @param KataRepository $repository
     * @param Environment $environment
     * @param KataRunner $runner
     */
    public function __construct(KataRepository $repository, Environment $environment, KataRunner $runner)
    {
        $this->katas = $repository;
        $this->environment = $environment;
        $this->runner = $runner;
    }

    /**
     * @param $kataName
     *
     * @throws \Star\Kata\Domain\Exception\DirtyEnvironmentException
     * @return \Star\Kata\Domain\StartedKata
     */
    public function startKata($kataName)
    {
        $this->guardAgainstInvalidName($kataName);

        $kata = $this->katas->findOneByName($kataName);
        $this->guardAgainstNotFoundKata($kataName, $kata);

        if (false === $this->environment->isClean()) {
            throw DirtyEnvironmentException::getEnvironmentIsDirtyException();
        }

        // todo add KataWasStartedEvent to print objectives?
        return $kata->start($this->environment);
    }

    /**
     * @param $kataName
     *
     * @return \Star\Kata\Domain\Objective\ObjectiveResult
     * @throws \RuntimeException
     */
    public function evaluate($kataName)
    {
        $this->guardAgainstInvalidName($kataName);

        $kata = $this->katas->findOneByName($kataName);
        $this->guardAgainstNotFoundKata($kataName, $kata);

        // todo add KataWasEvaluatedEvent to print result?
        return $kata->evaluate($this->runner);
    }

    /**
     * @param string $kataName
     * @param $kata
     * @throws \Star\Kata\Domain\Exception\EntityNotFoundException
     */
    private function guardAgainstNotFoundKata($kataName, $kata)
    {
        if (null === $kata) {
            throw new EntityNotFoundException("The '{$kataName}' kata was not found.");
        }
    }

    /**
     * @param string $kataName
     * @throws \Star\Kata\Domain\Exception\InvalidArgumentException
     */
    private function guardAgainstInvalidName($kataName)
    {
        if (empty($kataName)) {
            throw new InvalidArgumentException('The kata name is invalid.');
        }
    }
}
