<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

/**
 * Class StartedKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
final class StartedKata
{
    const CLASS_NAME = __CLASS__;

    /**
     * @var Kata
     */
    private $wrappedKata;

    /**
     * @param Kata $kata
     */
    public function __construct(Kata $kata)
    {
        $this->wrappedKata = $kata;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->wrappedKata->getName();
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->wrappedKata->getDescription();
    }
}
