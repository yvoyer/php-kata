<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\KataDomain;

use Star\Kata\Exception\EntityNotFoundException;
use Star\Kata\Exception\InvalidArgumentException;
use Star\Kata\Model\KataCollection;
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
     * @param KataRepository $repository
     */
    public function __construct(KataRepository $repository)
    {
        $this->katas = $repository;
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

        return $kata->start();
    }
}
