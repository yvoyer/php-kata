<?php

namespace Star\Kata\Data\Fibonacci;

use Star\Kata\Model\Objective\PHPUnit\ObjectiveTestCase;

final class FibonacciTest extends ObjectiveTestCase
{
    /**
     * @return string
     */
    public function description()
    {
        return 'Calculate the sum of the two previous numbers.';
    }

    public function testTheFibonacciClassShouldExists()
    {
        \PHPUnit_Framework_Assert::assertTrue(class_exists('\Fibonacci'));

        return new Fibonacci();
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testTheMethodShouldExists(Fibonacci $sequence)
    {
        \PHPUnit_Framework_Assert::assertTrue(method_exists($sequence, 'getNumber'));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testFirstNumberShouldBeZero(Fibonacci $sequence)
    {
        $this->assertSame(0, $sequence->getNumber(1));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testSecondNumberShouldBeOne(Fibonacci $sequence)
    {
        $this->assertSame(1, $sequence->getNumber(2));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testThirdNumberShouldBeOne(Fibonacci $sequence)
    {
        $this->assertSame(1, $sequence->getNumber(3));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testFourthNumberShouldBeTwo(Fibonacci $sequence)
    {
        $this->assertSame(2, $sequence->getNumber(4));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testFifthNumberShouldBeThree(Fibonacci $sequence)
    {
        $this->assertSame(3, $sequence->getNumber(5));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testSixthNumberShouldBeFive(Fibonacci $sequence)
    {
        $this->assertSame(5, $sequence->getNumber(6));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testSeventhNumberShouldBeEight(Fibonacci $sequence)
    {
        $this->assertSame(8, $sequence->getNumber(7));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testTwelveNumberShouldBeEightyNine(Fibonacci $sequence)
    {
        $this->assertSame(89, $sequence->getNumber(12));
    }

    /**
     * @depends testTheFibonacciClassShouldExists
     */
    public function testHighNumberShouldBePerformant(Fibonacci $sequence)
    {
        $this->assertSame(433494437, $sequence->getNumber(44));
    }
}