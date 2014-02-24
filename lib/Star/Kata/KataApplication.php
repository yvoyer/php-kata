<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata;

use Star\Kata\Command\InitCommand;
use Star\Kata\Command\KataCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\HelpCommand;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class KataApplication
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata
 */
class KataApplication extends Application
{
    const VERSION = '0.1.0';

    /**
     * @var string
     */
    private $root;

    public function __construct($root)
    {
        $this->root = $root;

        parent::__construct('phpkata', self::VERSION);
        $this->registerCommand(new InitCommand());
    }

    protected function registerCommand(KataCommand $command)
    {
        $command->update($this);
        $this->add($command);
    }

    /**
     * @return string
     */
    public function getRootPath()
    {
        return $this->root;
    }
}
 