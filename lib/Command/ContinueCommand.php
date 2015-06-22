<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Domain\Exception\KataException;
use Star\Kata\Domain\KataService;
use Star\Kata\Domain\View\Cli\SymfonyConsoleRenderer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ContinueCommand
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
class ContinueCommand extends Command
{
    /**
     * @var KataService
     */
    private $service;

    /**
     * @param KataService $service
     */
    public function __construct(KataService $service)
    {
        parent::__construct('continue');
        $this->service = $service;
    }

    public function configure()
    {
        $this->addArgument('kata', InputArgument::REQUIRED, 'Name of kata');
        $this->setDescription('End the specified kata.');
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface $input An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @throws \RuntimeException
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $renderer = new SymfonyConsoleRenderer($output);

        try {
            $kata = $input->getArgument('kata');
            $result = $this->service->evaluate($kata);

            // todo use event to render?
            $renderer->displayObjective($result->objective());
            if ($result->isSuccess()) {
                $renderer->displaySuccess($result);
            } else {
                $renderer->displayFailure($result);
            }
        } catch (KataException $e) {
            $renderer->displayError($e);
            return 1;
        }

        return 0;
    }
}
