<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

/**
 * Class KataRepository
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
interface KataRepository
{
    /**
     * @param string $name
     *
     * @return null|Kata
     */
    public function findOneByName($name);

    /**
     * @return Kata[]
     */
    public function findAllKatas();
}
