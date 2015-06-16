<?php

namespace Star;

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Context\ContextInterface;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use PHPUnit_Framework_Assert as Assert;
use Star\Fixture\AssertTrueKata;
use Star\Kata\Domain\KataService;
use Star\Kata\Infrastructure\Filesystem\FilesystemEnvironment;
use Star\Kata\Infrastructure\InMemory\KataCollection;
use Star\Kata\Infrastructure\PHPUnit\PHPUnitKataRunner;
use Star\Kata\KataApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

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
     * @var KataApplication
     */
    private $application;

    /**
     * @var BufferedOutput
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
        $this->basePath = __DIR__ . DIRECTORY_SEPARATOR . 'tmp';
        $this->environment = new FilesystemEnvironment($this->basePath);

        $this->application = new KataApplication(
            $this->environment,
            array(
                new AssertTrueKata(),
            )
        );
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
        $this->iStartTheKata($kataName);
    }

    /**
     * @Given /^The file \'([^\']*)\' contains the following code$/
     */
    public function theFileContainsTheFollowingCode($filename, PyStringNode $string)
    {
        $fullPath = $this->basePath . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($fullPath, $string->getRaw());
        Assert::fileExists($fullPath);
    }

    /**
     * @When /^I evaluate the kata \'([^\']*)\'$/
     */
    public function iEvaluateTheKata($kataName)
    {
        $this->runCommand('continue', array('kata' => $kataName));
    }

    private function runCommand($command, array $args = array())
    {
        $input = new ArrayInput(
            array_merge(
                array(
                    'command' => $command,
                ),
                $args
            )
        );
        $this->application->setAutoExit(false);
        $this->application->run($input, $this->output);
    }

    private function addSubContext(ContextInterface $context)
    {
        $name = get_class($context);
        $this->useContext($name, $context);
    }
}
