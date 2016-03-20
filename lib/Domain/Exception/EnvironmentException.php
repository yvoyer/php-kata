<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\Exception;

/**
 * Class EnvironmentException
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\Exception
 */
final class EnvironmentException extends \Exception implements KataException
{
    /**
     * @return EnvironmentException
     */
    public static function environmentIsDirty()
    {
        return new self('The environment seems to contain old data. Run the reset command to clean it up.');
    }

    /**
     * @return EnvironmentException
     */
    public static function environmentNotLoaded()
    {
        return new self('The environment is not loaded.');
    }
}
