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
        $classGenerator = new ClassGenerator();

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
        return '<?php
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

    public function testFirstNumberShouldBeZero()
    {
        $this->assertSame(0, $this->class->getNumber());
    }
}';
    }
}
