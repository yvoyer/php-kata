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
 * Class UserInputAValidInputScenario
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
final class UserInputAValidInputScenario extends BehatContext
{
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
}
