<?php

namespace spec\Star\Kata\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassGeneratorSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $filePath;

    function let()
    {
        $this->filePath = __DIR__ . '/SomeClass.php';
        $this->beConstructedWith(__DIR__);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Star\Kata\Generator\ClassGenerator');
    }

    function it_creates_a_file()
    {
        assertFileNotExists($this->filePath);
        $this->generate('SomeClass');
        assertFileExists($this->filePath);
    }

    function letgo()
    {
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
