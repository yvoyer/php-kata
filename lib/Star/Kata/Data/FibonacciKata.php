<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Data;

use Star\Kata\Configuration\Configuration;
use Star\Kata\Model\ClassTemplate;
use Star\Kata\Model\FileTemplate;
use Star\Kata\Model\Kata;
use Star\Kata\Model\Step\CreateClassStep;
use Star\Kata\Model\Step\TestStep;

/**
 * Class FibonacciKata
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Data
 */
class FibonacciKata extends Kata
{
    /**
     * @param Configuration $config
     */
    protected function configure(Configuration $config)
    {
        $this->setName('fibonacci');

        $this->addStep(
            new CreateClassStep(
                $config->getSrcPath(),
                new FileTemplate('FibonacciSequence', $this->getSystemUnderTestContent())
            )
        );
        $this->addStep(
            new CreateClassStep(
                $config->getSrcPath(),
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
