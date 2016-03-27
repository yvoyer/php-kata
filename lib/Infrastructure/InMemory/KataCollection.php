<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Infrastructure\InMemory;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Domain\Kata;
use Star\Kata\Domain\KataRepository;

/**
 * Class KataCollection
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Infrastructure\InMemory
 */
class KataCollection implements KataRepository
{
    /**
     * @var TypedCollection|Kata[]
     */
    private $katas;

    /**
     * @param Kata[] $katas
     */
    public function __construct(array $katas = array())
    {
        $this->katas = new TypedCollection('Star\Kata\Domain\Kata');
        $this->addKatas($katas);
    }

    /**
     * @param string $name
     *
     * @return Kata
     */
    public function findOneByName($name)
    {
        return $this->katas[$name];
    }

    /**
     * @param Kata[] $elements
     */
    private function addKatas(array $elements)
    {
        foreach ($elements as $element) {
            $this->addKata($element);
        }
    }

    /**
     * @param Kata $kata
     */
    public function addKata(Kata $kata)
    {
        $this->katas[$kata->name()] = $kata;
    }

    /**
     * Return the number of elements.
     *
     * @return int
     */
    public function count()
    {
        return count($this->katas);
    }

    /**
     * @return Kata[]
     */
    public function findAllKatas()
    {
        return $this->katas->toArray();
    }
}
