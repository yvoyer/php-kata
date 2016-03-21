<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Domain\KataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ShowCommand extends Command
{
    /**
     * @var KataService $service
     */
    private $service;

    /**
     * @param KataService $service
     */
    public function __construct(KataService $service)
    {
        $this->service = $service;
        parent::__construct('show');
    }

    protected function configure()
    {
        $this->setDescription('Show informations about the availables katas, or about a specific kata.');
        $this->setHelp(<<<EOF

 You can display all available registered katas using:

  <info>php %command.full_name%</info>

 Or show more information about a specific kata using:

  <info>php %command.full_name% <kata-name></info>

EOF
        );
        $this->addArgument('name', InputArgument::OPTIONAL, 'The name of a kata to visualize.');
        // todo add '--tags' option to show the availables kata tags
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \LogicException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if (! empty($name)) {
            $this->renderSingleKata($output, $name);
        }

        if (empty($name)) {
            $this->showAllKatas($output);
        }

        return 0;
    }

    /**
     * @param OutputInterface $output
     */
    private function showAllKatas(OutputInterface $output)
    {
        $message = <<<MESSAGE

  Here is a list of all available katas ready to be executed.

  You can start any kata using the <comment>start</comment> command:

    <info>phpkata.php start {kata-name}</info>

MESSAGE;
        $output->writeln($message);
        $output->writeln(['<comment>Available katas</comment>', '']);

        $style = new TableStyle();
        $style->setVerticalBorderChar(' ');
        $style->setHorizontalBorderChar(false);
        $style->setCrossingChar(false);
        $style->setCellHeaderFormat('<info> %s </info>');
        $style->setCellRowFormat(' %s ');

        $table = new Table($output);
        $table->setStyle($style);
        $table->setHeaders(
            [
                'Name',
                'Description',
            ]
        );
        foreach ($this->service->getAllRegisteredKatas() as $kata) {
            $table->addRow(
                [
                    "<comment>{$kata->name()}</comment>",
                    $kata->description(),
                ]
            );
        }
        $table->render();
        $output->writeln('');
    }

    /**
     * @param OutputInterface $output
     * @param $name
     */
    protected function renderSingleKata(OutputInterface $output, $name)
    {
        $kata = $this->service->searchKata($name);

        $output->writeln(['', '<comment>Kata information:</comment>', '']);
        $output->writeln(sprintf('<info>Kata:</info>           %s', $kata->name()));
        $output->writeln(sprintf('<info>Description:</info>    %s', $kata->description()));
        $output->writeln('<info>Objectives:</info> ');
    }
}
