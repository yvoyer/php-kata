<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\PHPUnit;

/**
 * Class NullPrinter
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\PHPUnit
 */
final class NullPrinter extends \PHPUnit_TextUI_ResultPrinter
{
    /**
     * @param string $buffer
     */
    public function write($buffer)
    {
        // Do nothing
    }
}
