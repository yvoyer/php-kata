<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Exception\Configuration;

use Star\Kata\Exception\KataException;

/**
 * Class MissingConfigurationException
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\KataException\Configuration
 */
class MissingConfigurationException extends \Exception implements KataException
{
    /**
     * @return MissingConfigurationException
     */
    public static function getNoKataDefinedException()
    {
        return new self("More than 1 katas must be defined.");
    }
}
