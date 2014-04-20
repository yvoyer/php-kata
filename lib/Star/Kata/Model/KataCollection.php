<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

use Star\Component\Collection\TypedCollection;

/**
 * Class KataCollection
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
class KataCollection
{
    /**
     * @var TypedCollection|Kata[]
     */
    private $katas;

    public function __construct()
    {
        $this->katas = new TypedCollection(Kata::CLASS_NAME);
    }

    /**
     * @param string $name
     *
     * @return Kata
     */
    public function getKata($name)
    {
        return $this->katas[$name];
    }

    /**
     * @param string $name
     * @param Kata   $kata
     */
    public function addKata($name, Kata $kata)
    {
        $this->katas[$name] = $kata;
    }
}
