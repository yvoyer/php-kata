<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace tests\PHPUnit\Domain;

use Star\Kata\KataDomain\KataService;
use tests\PHPUnit\KataMock;

/**
 * Class KataServiceTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package tests\PHPUnit\Domain
 */
final class KataServiceTest extends \PHPUnit_Framework_TestCase
{
    use KataMock;

    /**
     * @var KataService
     */
    private $service;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $environment;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $repository;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $kata;

    public function setUp()
    {
        $this->kata = $this->getMockKata();
        $this->environment = $this->getMockEnvironment();
        $this->repository = $this->getMockKataRepository();

        $this->service = new KataService($this->repository, $this->environment);
    }

    /**
     * @expectedException        \Star\Kata\Exception\InvalidArgumentException
     * @expectedExceptionMessage The kata name is invalid.
     */
    public function test_starting_a_kata_with_empty_name_should_throw_exception()
    {
        $this->service->startKata('');
    }

    /**
     * @expectedException        \Star\Kata\Exception\InvalidArgumentException
     * @expectedExceptionMessage The kata name is invalid.
     */
    public function test_evaluating_a_kata_with_empty_name_should_throw_exception()
    {
        $this->service->evaluate('');
    }

    /**
     * @expectedException        \Star\Kata\Exception\EntityNotFoundException
     * @expectedExceptionMessage The 'invalid' kata was not found.
     */
    public function test_starting_a_not_found_kata_should_throw_exception()
    {
        $this->service->startKata('invalid');
    }

    /**
     * @expectedException        \Star\Kata\Exception\EntityNotFoundException
     * @expectedExceptionMessage The 'invalid' kata was not found.
     */
    public function test_evaluating_a_kata_hot_found_should_throw_exception()
    {
        $this->service->evaluate('invalid');
    }

    public function test_it_should_start_the_kata()
    {
        $this->repository
            ->expects($this->once())
            ->method('findOneByName')
            ->willReturn($this->kata);

        $this->kata
            ->expects($this->once())
            ->method('start')
            ->willReturn('return');

        $this->assertSame('return', $this->service->startKata('name'));
    }

    public function test_it_should_evaluate_the_kata()
    {
        $this->repository
            ->expects($this->once())
            ->method('findOneByName')
            ->willReturn($this->kata);

        $this->kata
            ->expects($this->once())
            ->method('evaluate')
            ->willReturn('return');

        $this->assertSame('return', $this->service->evaluate('name'));
    }
}
