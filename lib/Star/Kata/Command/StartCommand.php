<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Configuration\Configuration;
use Star\Kata\Exception\Exception;
use Star\Kata\Model\KataCollection;
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
     * @var KataCollection
     */
    private $collection;

    /**
     * @param KataCollection $collection
     */
    public function __construct(KataCollection $collection)
    {
        parent::__construct('start');
        $this->collection = $collection;
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
        try {
            $kataName = $input->getArgument('kata');
            if (empty($kataName)) {
                throw new \RuntimeException('Kata must be supplied.');
            }

            $kata = $this->collection->getKata($kataName);
            if (null === $kata) {
                throw new \RuntimeException("The '{$kataName}' kata was not found.");
            }

            $kata->start();
            $output->writeln('<info>' . $kata->getDescription() . '</info>');
        } catch (Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return 1;
        }

        return 0;
    }
}
 