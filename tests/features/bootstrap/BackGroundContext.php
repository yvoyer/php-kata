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
use Star\Kata\Builder\KataBuilder;
use Star\Kata\Infrastructure\KataInfrastructure;

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
     * @var KataBuilder
     */
    private $kataBuilder;

    /**
     * @var KataInfrastructure
     */
    private $infrastructure;

    public function __construct(KataBuilder $builder, KataInfrastructure $infrastructure)
    {
        $this->kataBuilder = $builder;
        $this->infrastructure = $infrastructure;
    }

    /**
     * @Given /^The kata name is \'([^\']*)\'$/
     */
    public function theKataNameIs($kataName)
    {
        $this->kataBuilder
            ->withName($kataName);
    }

    /**
     * @Given /^The \'([^\']*)\' kata has the following objectives$/
     */
    public function theKataHasTheFollowingObjectives($arg1, TableNode $table)
    {
        foreach ($table->getHash() as $row) {
            $code = $row['code'];
            $closure = function() use ($code) {
                return eval($code);
            };
            $this->kataBuilder
                ->withObjective($row['description'], $closure);
        }
    }

    /**
     * @Given /^The kata \'([^\']*)\' is registered$/
     */
    public function theKataIsRegistered($arg1)
    {
        $kata = $this->kataBuilder
            ->build();

        $this->infrastructure->kataRepository()->addKata($kata);
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
