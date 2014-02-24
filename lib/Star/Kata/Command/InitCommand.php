<?php
/**
 * This file is part of the phpkata project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Kata\Command;

use Star\Kata\Configuration\YamlLoader;
use Star\Kata\KataApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class TestCommand
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Kata\Command
 */
class InitCommand extends Command implements KataCommand
{
    /**
     * @var string
     */
    private $root;

    public function configure()
    {
        $this->setName('init');

        $this->addArgument('kata', InputArgument::REQUIRED, 'Name of kata');
    }

    /**
     * Executes the current command.
     *
     * This method is not abstract because you can use this class
     * as a concrete class. In this case, instead of defining the
     * execute() method, you set the code to execute by passing
     * a Closure to the setCode() method.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|integer null or 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract method is not implemented
     * @see    setCode()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (empty($this->root)) {
            throw new \RuntimeException('Root is not defined.');
        }

        $kata = $input->getArgument('kata');
        if (empty($kata)) {
            throw new \RuntimeException('Kata must be supplied.');
        }

        $configFile = $this->root . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'db.kata';

        $loader = new YamlLoader();
        $configuration = $loader->load($configFile);


var_dump($configuration);
//        mkdir($this->root . DIRECTORY_SEPARATOR . 'src');
//        $sutFile = file_put_contents(
//            $this->root . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . ucfirst($name), // todo use inflector
//            file_get_contents($this->root . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $srcFile . '.kata')
//        );
//
//        var_dump($this->root);


    }

    /**
     * @param KataApplication $application
     */
    public function update(KataApplication $application)
    {
        $this->root = $application->getRootPath();
    }
}
 