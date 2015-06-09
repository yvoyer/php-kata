<?php
/**
 * This file is part of the phpkata project.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star;

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Context\ContextInterface;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use PHPUnit_Framework_Assert as Assert;
use Star\Kata\PHPUnit\KataTestCase;

/**
 * Class SelectKataContext
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
final class SelectKataContext extends BehatContext
{
    /**
     * @var array
     */
    private $katas = array();

    /**
     * @var \PHPUnit_Framework_TestResult
     */
    private $result;

    /**
     * @Given /^The kata registry contains kata (\d+)$/
     */
    public function theKataRegistryContainsKata($index, PyStringNode $kataInfo)
    {
        $this->katas[$index] = $kataInfo->getRaw();
    }

    /**
     * @Given /^I run the kata \'([^\']*)\' with user inputs$/
     */
    public function iRunTheKataWithUserInputs($kataIndex, PyStringNode $inputCode)
    {
        $testCase = new KataTestCase($this->katas[$kataIndex]);

        $this->result = $testCase->run($inputCode->getRaw());
    }

    /**
     * @Then /^There should be (\d+) failures$/
     */
    public function thereShouldBeFailures($failureCount)
    {
        Assert::assertSame((int) $failureCount, $this->result->failureCount());
    }

    /**
     * @Given /^The test should be successful$/
     */
    public function theTestShouldBeSuccessful()
    {
        Assert::assertTrue($this->result->wasSuccessful());
    }

    /**
     * @Given /^The test should be failed$/
     */
    public function theTestShouldBeFailed()
    {
        Assert::assertFalse($this->result->wasSuccessful());
    }
}
