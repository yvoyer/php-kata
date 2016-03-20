<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Exception;

/**
 * Class EntityNotFoundException
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Exception
 */
class EntityNotFoundException extends RuntimeException
{
    /**
     * @param string $name
     *
     * @return EntityNotFoundException
     */
    public static function kataWithNameNotFound($name)
    {
        return new self("The '{$name}' kata was not found.");
    }
}
