<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Configuration;

use Star\Component\Collection\TypedCollection;
use Star\Kata\Exception\InvalidArgumentException;
use Star\Kata\Exception\RuntimeException;
use Star\Kata\Model\Kata;

/**
 * Class Configuration
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Configuration
 */
class Configuration
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var string
     */
    private $srcPath;

    /**
     * @var Kata[]|TypedCollection
     */
    private $kataCollection;

    public function __construct()
    {
        $this->kataCollection = new TypedCollection(Kata::CLASS_NAME);
    }

    /**
     * Return the Kata with $name.
     *
     * @param string $name
     *
     * @throws \Star\Kata\Exception\InvalidArgumentException
     * @return Kata
     */
    public function getKata($name)
    {
        $kata = $this->kataCollection->get($name);
        if (null === $kata) {
            throw new InvalidArgumentException("Kata with name '{$name}' was not found.");
        }

        return $kata;
    }

    /**
     * Set the name.
     *
     * @param string $name
     */
    public function addKata($name)
    {
        $this->kataCollection->set($name, new Kata($name));
    }

    /**
     * Returns the SrcPath.
     *
     * @throws \Star\Kata\Exception\RuntimeException
     * @return string
     */
    public function getSrcPath()
    {
        if (empty($this->srcPath)) {
            throw new RuntimeException('SrcPath must be set.');
        }

        return $this->srcPath;
    }

    /**
     * Set the srcPath.
     *
     * @param string $srcPath
     */
    public function setSrcPath($srcPath)
    {
        $this->srcPath = $srcPath;
    }
}
