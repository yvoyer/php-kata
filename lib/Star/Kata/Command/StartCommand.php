<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Exception\KataException;
use Star\Kata\KataDomain\KataService;
use Star\Kata\View\SymfonyConsoleRenderer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StartCommand
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
class StartCommand extends Command
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
        parent::__construct('start');
        $this->service = $service;
    }

    public function configure()
    {
        $this->addArgument('kata', InputArgument::REQUIRED, 'Name of kata');
        $this->setDescription('Start the specified kata.');
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
        $kataName = $input->getArgument('kata');
        $renderer = new SymfonyConsoleRenderer($output);

        try {
            $kata = $this->service->startKata($kataName);

            // todo use event to render?
            $renderer->displayKata($kata);
        } catch (KataException $e) {
            $renderer->displayError($e);
            return 1;
        }

        return 0;
    }
}
