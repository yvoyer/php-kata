<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Fixture\AssertFalse;

use Star\Kata\Infrastructure\PHPUnit\PHPUnitObjective;
use AssertFalse;

/**
 * Class AssertFalseObjective
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Fixture\AssertFalse
 */
final class AssertFalseObjective extends PHPUnitObjective
{
    public function test_class_should_exists()
    {
        $this->assertTrue(class_exists('AssertFalse'));
    }

    /**
     * @depends test_class_should_exists
     */
    public function test_method_should_exists()
    {
        $this->assertTrue(method_exists('AssertFalse', 'getValue'));
    }

    /**
     * @depends test_method_should_exists
     */
    public function test_it_should_always_fails()
    {
        $this->assertTrue(AssertFalse::getValue());
    }

    /**
     * @return string
     */
    public function description()
    {
        return 'Always return false';
    }
}
