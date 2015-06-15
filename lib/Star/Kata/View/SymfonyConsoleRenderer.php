<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\View;

use Star\Kata\Model\Objective\Objective;
use Star\Kata\Model\Objective\ObjectiveResult;
use Star\Kata\Model\StartedKata;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SymfonyConsoleRenderer
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\View
 */
final class SymfonyConsoleRenderer implements ResultRenderer
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * @param ObjectiveResult $result
     */
    public function displaySuccess(ObjectiveResult $result)
    {
        $this->output->writeln('    <comment>ObjectiveTestCase completed: ' . $result->points() . ' points.</comment>');
    }

    /**
     * @param ObjectiveResult $result
     */
    public function displayFailure(ObjectiveResult $result)
    {
        $this->output->writeln('    <error>ObjectiveTestCase failed with ' . $result->points() . '/' . $result->maxPoints() . ' points</error>');
    }

    /**
     * @param Objective $objective
     */
    public function displayObjective(Objective $objective)
    {
        $this->output->writeln('<info>' . $objective->description() . '</info>');
    }

    /**
     * @param \Exception $exception
     */
    public function displayError(\Exception $exception)
    {
        $this->output->writeln('<error>' . $exception->getMessage() . '</error>');
    }

    /**
     * @param StartedKata $kata
     */
    public function displayKata(StartedKata $kata)
    {
        $this->output->writeln("Kata: <comment>{$kata->getName()}</comment>");
        $this->output->writeln("Description: <info>{$kata->getDescription()}</info>");
    }
}
