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
 * Class ContinueCommand
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
class ContinueCommand extends Command
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
        parent::__construct('continue');
        $this->collection = $collection;
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
        try {
            $kata = $input->getArgument('kata');
            if (empty($kata)) {
                throw new \RuntimeException('Kata must be supplied.');
            }

            $kata = $this->collection->getKata($kata);

            $output->writeln('<info>' . $kata->getDescription() . '</info>');
            $result = $kata->end();

            if ($result->isSuccess()) {
                $output->writeln('    <comment>Objective completed: ' . $result->getPoints() . ' points.</comment>');
            } else {
                $output->writeln('    <error>Objective failed with ' . $result->getPoints() . ' points</error>');
            }
        } catch (Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return 1;
        }

        return 0;
    }
}
 