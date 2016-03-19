<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

use Star\Kata\Domain\DTO\StartedKata;
use Star\Kata\Domain\Exception\EnvironmentException;
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
     * @throws \Star\Kata\Domain\Exception\EnvironmentException
     * @return StartedKata
     */
    public function startKata($kataName)
    {
        $this->guardAgainstInvalidName($kataName);

        $kata = $this->katas->findOneByName($kataName);
        $this->guardAgainstNotFoundKata($kataName, $kata);

        if (false === $this->environment->isClean()) {
            throw EnvironmentException::environmentIsDirty();
        }

        return $kata->start($this->environment);
    }

    /**
     * @return Kata
     */
    public function getCurrentKata()
    {
        return $this->katas->findOneByName($this->environment->currentKata());
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

        return $kata->end($this->runner, $this->environment);
    }

    /**
     * @param string $kataName
     * @param $kata
     * @throws \Star\Kata\Domain\Exception\EntityNotFoundException
     */
    private function guardAgainstNotFoundKata($kataName, $kata)
    {
        if (null === $kata) {
            throw EntityNotFoundException::kataWithNameNotFound($kataName);
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
