<?php

namespace Star\Kata\Domain;

use Star\Kata\KataApplicationTester;

final class Issue39Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KataApplicationTester
     */
    private $tester;

    public function setUp()
    {
        $this->tester = new KataApplicationTester();
    }

    public function test_it_should_keep_the_current_kata_when_continue_with_not_completed_kata()
    {
        $result = $this->tester->executeStartCommand('fibonacci');
        $this->assertSame(0, $result->getStatusCode());

        $result = $this->tester->executeContinueCommand('fibonacci');
        $this->assertSame(0, $result->getStatusCode());

        $result = $this->tester->executeContinueCommand('fibonacci');
        var_dump($result->getDisplay());
        $this->assertSame(0, $result->getStatusCode(), 'The current kata should continue');
    }
}
