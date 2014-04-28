<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Data;

use Star\Kata\Generator\ClassGenerator;
use Star\Kata\Model\FileTemplate;
use Star\Kata\Model\Kata;
use Star\Kata\Model\Step\CreateClassStep;

/**
 * Class FibonacciKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Data
 */
class FibonacciKata extends Kata
{
    protected function configure()
    {
        $this->setName('fibonacci');
        $classGenerator = new ClassGenerator($this->getSrcPath());

        $this->addStep(
            new CreateClassStep(
                $classGenerator,
                new FileTemplate('FibonacciSequence', $this->getSystemUnderTestContent())
            )
        );
        $this->addStep(
            new CreateClassStep(
                $classGenerator,
                new FileTemplate('FibonacciSequenceTest', $this->getTestContent())
            )
        );

        $this->setDescription(<<<INFO

Fibonacci sequence
Objective: calculate the sum of the two previous numbers.

INFO
        );
    }

    private function getSystemUnderTestContent()
    {
        return <<<SUTCONTENT
<?php
class FibonacciSequence
{
    public function getNumber()
    {
    }
}
SUTCONTENT;
    }

    private function getTestContent()
    {
        return '
<?php
class FibonacciSequenceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FibonacciSequence
     */
    private $class;

    public function setUp()
    {
        $this->class = new \FibonacciSequence();
    }

    /**
     * @dataProvider providePositionForNumber
     */
    public function testFirstNumberShouldBeZero($expected, $position)
    {
        $this->assertSame($expected, $this->class->getNumber($position));
    }

    public function providePositionForNumber()
    {
        return array(
            "FirstNumberShouldBeZero" => array(0, 1),
            "SecondNumberShouldBeOne" => array(1, 2),
            "ThirdNumberShouldBeOne" => array(1, 3),
            "FourthNumberShouldBeTwo" => array(2, 4),
            "FifthNumberShouldBeThree" => array(3, 5),
            "SixthNumberShouldBeFive" => array(5, 6),
            "SeventhNumberShouldBeEight" => array(8, 7),
            array(0, 0),
            array(13, 8),
            array(21, 9),
            array(34, 10),
            array(55, 11),
            array(89, 12),
            "Performance issue #1" => array(267914296, 43),
            "Performance issue #2" => array(433494437, 44),
            "Performance issue #3" => array(679891637638612258, 88),
        );
    }
}
';
    }
}
