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
        $sutContent = <<<SUTCONTENT

<?php
class FibonacciSequence
{
    public function getNumber()
    {
    }
}
SUTCONTENT;

        $testContent = <<<TESTCONTENT

TESTCONTENT;

        $this->addStep(new CreateClassStep($config->getSrcPath(), new FileTemplate('FibonacciSequence', $sutContent)));
//        $this->addStep(new CreateClassStep($config->getSrcPath(), new FileTemplate('FibonacciSequenceTest', $testContent)));


        $this->setDescription(<<<INFO

Fibonacci sequence
Objective: calculate the sum of the two previous numbers.

INFO
        );
    }
}
