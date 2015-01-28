<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Model;

/**
 * Class KataRepository
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Model
 */
interface KataRepository
{
    const INTERFACE_NAME = __CLASS__;

    /**
     * @param string $name
     *
     * @return null|Kata
     */
    public function findOneByName($name);
}
