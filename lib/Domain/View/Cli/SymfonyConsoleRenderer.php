<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Domain\View\Cli;

use Star\Kata\Domain\Objective\Objective;
use Star\Kata\Domain\Objective\ObjectiveResult;
use Star\Kata\Domain\StartedKata;
use Star\Kata\Domain\View\ResultRenderer;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SymfonyConsoleRenderer
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Domain\View\Cli
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
        $this->output->writeln('<comment>You finished all the objectives, ' . $result->points() . ' points awarded.</comment>');
    }

    /**
     * @param ObjectiveResult $result
     */
    public function displayFailure(ObjectiveResult $result)
    {
        $this->output->writeln('<error>You succeed ' . $result->points() . '/' . $result->maxPoints() . ' objectives, ' . $result->points() . ' points awarded. Keep trying.</error>');
    }

    /**
     * @param Objective $objective
     */
    public function displayObjective(Objective $objective)
    {
        $this->output->writeln('Objective: <info>' . $objective->description() . '</info>');
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
