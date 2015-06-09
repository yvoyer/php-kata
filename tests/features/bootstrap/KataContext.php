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
        $this->addSubContext(new BackGroundContext());
        $this->addSubContext(new SelectKataContext());
    }

    private function addSubContext(ContextInterface $context)
    {
        $name = get_class($context);
        $this->useContext($name, $context);
    }
}
