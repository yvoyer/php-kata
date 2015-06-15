<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\KataDomain;

use Star\Kata\Exception\EntityNotFoundException;
use Star\Kata\Exception\InvalidArgumentException;
use Star\Kata\Generator\ClassGenerator;
use Star\Kata\KataRunner;
use Star\Kata\Model\Environment;
use Star\Kata\Model\KataRepository;

/**
 * Class KataService
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\KataDomain
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
     * @param KataRepository $repository
     * @param Environment $environment
     */
    public function __construct(KataRepository $repository, Environment $environment)
    {
        $this->katas = $repository;
        $this->environment = $environment;
    }

    /**
     * @param $kataName
     *
     * @return \Star\Kata\Model\StartedKata
     * @throws \Star\Kata\Exception\EntityNotFoundException
     * @throws \Star\Kata\Exception\InvalidArgumentException
     */
    public function startKata($kataName)
    {
        $this->guardAgainstInvalidName($kataName);

        $kata = $this->katas->findOneByName($kataName);
        $this->guardAgainstNotFoundKata($kataName, $kata);

        return $kata->start($this->environment);
    }

    /**
     * @param $kataName
     *
     * @return \Star\Kata\Model\Objective\ObjectiveResult
     * @throws \RuntimeException
     */
    public function evaluate($kataName)
    {
        $this->guardAgainstInvalidName($kataName);

        $kata = $this->katas->findOneByName($kataName);
        $this->guardAgainstNotFoundKata($kataName, $kata);

        return $kata->evaluate(new KataRunner());
    }

    /**
     * @param string $kataName
     * @param $kata
     * @throws \Star\Kata\Exception\EntityNotFoundException
     */
    private function guardAgainstNotFoundKata($kataName, $kata)
    {
        if (null === $kata) {
            throw new EntityNotFoundException("The '{$kataName}' kata was not found.");
        }
    }

    /**
     * @param string $kataName
     * @throws \Star\Kata\Exception\InvalidArgumentException
     */
    private function guardAgainstInvalidName($kataName)
    {
        if (empty($kataName)) {
            throw new InvalidArgumentException('The kata name is invalid.');
        }
    }
}
