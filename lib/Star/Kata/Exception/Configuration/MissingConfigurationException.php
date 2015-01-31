<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Exception\Configuration;

use Star\Kata\Exception\Exception;

/**
 * Class MissingConfigurationException
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Exception\Configuration
 */
class MissingConfigurationException extends \Exception implements Exception
{
    /**
     * @return MissingConfigurationException
     */
    public static function getNoKataDefinedException()
    {
        return new self("More than 1 katas must be defined.");
    }
}
