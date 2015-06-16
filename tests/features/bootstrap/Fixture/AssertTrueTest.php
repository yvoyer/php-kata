<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture;

use Star\Kata\Infrastructure\PHPUnit\PHPUnitObjective;

/**
 * Class AssertTrueTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture
 */
final class AssertTrueTest extends PHPUnitObjective
{
    public function test_method_should_exists()
    {
        $this->assertTrue(function_exists('getValue'));
    }

    /**
     * @depends test_method_should_exists
     */
    public function test_it_should_always_return_true()
    {
        $this->assertTrue(getValue());
    }

    /**
     * @return string
     */
    public function description()
    {
        return 'Always return true';
    }
}
