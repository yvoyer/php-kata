<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Exception;

/**
 * Class DirtyEnvironmentException
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Exception
 */
final class DirtyEnvironmentException extends \Exception implements KataException
{
    /**
     * @return DirtyEnvironmentException
     */
    public static function getEnvironmentIsDirtyException()
    {
        return new self('The environment seems to contain old data. Run the reset command to clean it up.');
    }
}
