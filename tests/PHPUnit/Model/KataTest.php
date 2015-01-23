<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Model;

use Star\Kata\Model\Kata;

/**
 * Class KataTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit\Model
 */
final class KataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Kata
     */
    private $kata;

    public function setUp()
    {
        $this->kata = new Kata('path', 'name');
    }

    public function test_get_name_should_return_the_name()
    {
        $this->assertSame('name', $this->kata->getName());
    }
}
