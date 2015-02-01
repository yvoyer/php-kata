<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star;

use Behat\Behat\Context\ContextInterface;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use PHPUnit_Framework_Assert as Assert;
use Star\Kata\Infrastructure\KataInfrastructure;
use Star\Kata\KataApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

/**
 * Class UserStartsAKataScenario
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
final class UserStartsAKataScenario extends BehatContext
{
    /**
     * @var KataApplication
     */
    private $application;

    /**
     * @var BufferedOutput
     */
    private $output;

    public function __construct(KataApplication $application)
    {
        $this->application = $application;
        $this->output = new BufferedOutput();
    }

    /**
     * @Given /^the kata \'([^\']*)\' was never started$/
     */
    public function theKataWasNeverStarted($arg1)
    {
    }

    /**
     * @When /^I launch the kata \'([^\']*)\'$/
     */
    public function iLaunchTheKata($kataName)
    {
        $this->application->setAutoExit(false);
        $this->application->run(
            new ArrayInput(array(
                'command' => 'start',
                'kata' => $kataName,
            )),
            $this->output
        );
    }

    /**
     * @Then /^I should see the objective description "([^"]*)"$/
     */
    public function iShouldSeeTheObjectiveDescription($description)
    {
        Assert::assertContains($description, $this->output->fetch());
    }

    /**
     * @Given /^I should be prompt to enter the php code$/
     */
    public function iShouldBePromptToEnterThePhpCode()
    {
        throw new PendingException();
    }
}
