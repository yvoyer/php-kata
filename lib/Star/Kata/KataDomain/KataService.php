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
     * @var ClassGenerator
     */
    private $generator;

    /**
     * @param KataRepository $repository
     * @param ClassGenerator $generator
     */
    public function __construct(KataRepository $repository, ClassGenerator $generator)
    {
        $this->katas = $repository;
        $this->generator = $generator;
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
        if (empty($kataName)) {
            throw new InvalidArgumentException('Kata must be supplied.');
        }

        $kata = $this->katas->findOneByName($kataName);
        if (null === $kata) {
            throw new EntityNotFoundException("The '{$kataName}' kata was not found.");
        }

        return $kata->start($this->generator);
    }

    /**
     * @param $kataName
     *
     * @return \Star\Kata\Model\Objective\ObjectiveResult
     * @throws \RuntimeException
     */
    public function evaluate($kataName)
    {
        if (empty($kataName)) {
            throw new \RuntimeException('Kata must be supplied.');
        }

        $kata = $this->katas->findOneByName($kataName);

        return $kata->evaluate(new KataRunner());
    }
}
