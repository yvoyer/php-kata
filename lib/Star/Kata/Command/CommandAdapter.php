<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Configuration\Configuration;
use Star\Kata\Exception\Exception;
use Star\Kata\Model\Kata;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommandAdapter
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
class CommandAdapter extends Command
{
    /**
     * @var \Star\Kata\Model\Kata
     */
    private $kata;

    /**
     * @param Kata $kata
     */
    public function __construct(Kata $kata)
    {
        $this->kata = $kata;
        parent::__construct($this->kata->getName());
    }

    public function configure()
    {
        $this->addOption('start', 's', InputOption::VALUE_NONE, 'Start the kata');
        $this->setDescription($this->kata->getDescription());
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
        try {
            $output->writeln('<info>' . $this->kata->getDescription() . '</info>');

            if ($input->getOption('start')) {
                $this->kata->start();
            }
        } catch (Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return 1;
        }

        return 0;
    }
}
 