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

/**
 * Class BackGroundContext
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
final class BackGroundContext extends BehatContext
{
    /**
     * @Given /^The kata name is \'([^\']*)\'$/
     */
    public function theKataNameIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The test requirement code for \'([^\']*)\' kata should be$/
     */
    public function theTestRequirementCodeForKataShouldBe($arg1, PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The \'([^\']*)\' kata objective is "([^"]*)"$/
     */
    public function theKataObjectiveIs($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given /^the kata \'([^\']*)\' was never started$/
     */
    public function theKataWasNeverStarted($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When /^I launch the kata \'([^\']*)\'$/
     */
    public function iLaunchTheKata($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see \'Objective: Assert that a function named \'([^\']*)\' always returns true\.\'$/
     */
    public function iShouldSeeObjectiveAssertThatAFunctionNamedAlwaysReturnsTrue($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I should be prompt to enter the php code$/
     */
    public function iShouldBePromptToEnterThePhpCode()
    {
        throw new PendingException();
    }

    /**
     * @Given /^The kata \'([^\']*)\' is started$/
     */
    public function theKataIsStarted($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^I fill the following code$/
     */
    public function iFillTheFollowingCode(PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @When /^I finish the kata \'([^\']*)\'$/
     */
    public function iFinishTheKata($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should see a \'([^\']*)\' test$/
     */
    public function iShouldSeeATest($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The following message should be visible \'([^\']*)\'$/
     */
    public function theFollowingMessageShouldBeVisible($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given /^The following message should be visible \'Failed asserting that the \'([^\']*)\' method was called\'$/
     */
    public function theFollowingMessageShouldBeVisibleFailedAssertingThatTheMethodWasCalled($arg1)
    {
        throw new PendingException();
    }

}
