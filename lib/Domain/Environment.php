<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain;

/**
 * Class Environment
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain
 */
interface Environment
{
    /**
     * @param string $className
     */
    public function generateClass($className);

    /**
     * @param string $name
     * @param array $args
     */
    public function generateMethod($name, array $args = array());

    /**
     * Check if the environment already contains data.
     *
     * @return bool
     */
    public function isClean();

    public function clear();
}
