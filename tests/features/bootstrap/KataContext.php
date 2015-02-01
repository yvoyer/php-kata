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
use Star\Kata\Builder\KataBuilder;
use Star\Kata\Infrastructure\InMemoryInfrastructure;
use Star\Kata\KataApplication;

/**
 * Features context.
 */
class KataContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $builder = new KataBuilder();
        $infrastructure = new InMemoryInfrastructure();
        $application = new KataApplication('path', $infrastructure);

        $this->addSubContext(new BackGroundContext($builder, $infrastructure));
        $this->addSubContext(new UserStartsAKataScenario($application));
        $this->addSubContext(new UserInputAValidInputScenario());
    }

    private function addSubContext(ContextInterface $context)
    {
        $name = get_class($context);
        $this->useContext($name, $context);
    }
}
