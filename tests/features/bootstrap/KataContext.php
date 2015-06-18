<?php

namespace Star;

use Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit_Framework_Assert as Assert;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Features context.
 */
class KataContext extends BehatContext
{
    /**
     * @var FilesystemEnvironment
     */
    private $environment;

    /**
     * @var Output
     */
    private $output;

    /**
     * @var string
     */
    private $basePath;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->output = new BufferedOutput();
        $this->basePath = __DIR__ . DIRECTORY_SEPARATOR . '/../tmp';
        $this->environment = new FilesystemEnvironment($this->basePath);
    }

    /**
     * @Given /^The \'([^\']*)\' kata exists$/
     */
    public function theKataExists($kataName)
    {
        // todo Add assertion that $kataName is in output of list command
    }

    /**
     * @Given /^The code environment is empty$/
     */
    public function theCodeEnvironmentIsEmpty()
    {
        $this->environment->clear();
        Assert::assertTrue($this->environment->isClean());
    }

    /**
     * @When /^I start the kata \'([^\']*)\'$/
     */
    public function iStartTheKata($kataName)
    {
        $this->runCommand('start', array('kata' => $kataName));
    }

    /**
     * @Then /^I should see$/
     */
    public function iShouldSee(PyStringNode $string)
    {
        Assert::assertSame($string->getRaw(), $this->output->fetch());
    }

    /**
     * @Given /^The code kata \'([^\']*)\' is started$/
     */
    public function theCodeKataIsStarted($kataName)
    {
        $this->runCommand('start', array('kata' => $kataName), true);
    }

    /**
     * @Given /^The file \'([^\']*)\' contains the following code$/
     */
    public function theFileContainsTheFollowingCode($filename, PyStringNode $string)
    {
        $fullPath = $this->basePath . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($fullPath, $string->getRaw());
        Assert::assertFileExists($fullPath);
        Assert::assertTrue(class_exists('AssertTrue'));
    }

    /**
     * @When /^I evaluate the kata \'([^\']*)\'$/
     */
    public function iEvaluateTheKata($kataName)
    {
        $this->runCommand('continue', array('kata' => $kataName));
    }

    private function runCommand($command, array $args, $silenceOutput = false)
    {
        $phpBinary = new PhpExecutableFinder();

        $processBuilder = new ProcessBuilder([
            'phpkata.php',
            $command
        ] + $args);
        $processBuilder->setWorkingDirectory(__DIR__ . '/../');
        $processBuilder->setPrefix($phpBinary->find());

        $process = $processBuilder->getProcess();

        $output = null;
        if (!$silenceOutput) {
            $output = function ($type, $buffer) {
                $this->output->write($buffer);
            };
        }

        $process->run($output);

        if (!$silenceOutput && !$process->isSuccessful()) {
            $this->output->write($process->getErrorOutput());
        }
    }
}
