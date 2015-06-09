<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\AssertTrue;

use Star\Kata\Infrastructure\PHPUnit\PHPUnitObjective;
use AssertTrue;

/**
 * Class AssertTrueObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\AssertTrue
 */
final class AssertTrueObjective extends PHPUnitObjective
{
    public function test_class_should_exists()
    {
        $this->assertTrue(class_exists('AssertTrue'));
    }

    /**
     * @depends test_class_should_exists
     */
    public function test_method_should_exists()
    {
        $this->assertTrue(method_exists('AssertTrue', 'getValue'));
    }

    /**
     * @depends test_method_should_exists
     */
    public function test_it_should_always_return_true()
    {
        $this->assertTrue(AssertTrue::getValue());
    }

    /**
     * @return string
     */
    public function description()
    {
        return 'Always return true';
    }
}
