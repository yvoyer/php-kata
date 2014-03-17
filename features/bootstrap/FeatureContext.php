<?php

namespace {
    use Behat\Behat\Context\ClosuredContextInterface,
        Behat\Behat\Context\TranslatedContextInterface,
        Behat\Behat\Context\BehatContext,
        Behat\Behat\Exception\PendingException;
    use Behat\Gherkin\Node\PyStringNode,
        Behat\Gherkin\Node\TableNode;
    use org\bovigo\vfs\vfsStream;
    use Star\Kata\Configuration\Configuration;
    use Star\Kata\Configuration\YamlLoader;
    use Star\Kata\KataApplication;
    use Star\Kata\Model\Kata;
    use Symfony\Component\Console\Tester\ApplicationTester;

    /**
     * Features context.
     */
    class FeatureContext extends BehatContext
    {
        /**
         * @var KataApplication
         */
        private $application;

        /**
         * @var Kata
         */
        private $kata;

        /**
         * Initializes context.
         * Every scenario gets it's own context object.
         *
         * @param array $parameters context parameters (set them up through behat.yml)
         */
        public function __construct(array $parameters)
        {
            vfsStream::setup('src');
            $yamlLoader = new YamlLoader(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'kata' . DIRECTORY_SEPARATOR . 'php-kata.yml');
            $config = $yamlLoader->load();
            $config->setSrcPath(vfsStream::url('src'));

            $this->application = new KataApplication($config);
            $this->application->setAutoExit(false);
        }

        /**
         * @Given /^I have the \'([^\']*)\' configuration$/
         */
        public function iHaveTheConfiguration($kataFile)
        {
//            assertFileExists($this->getKataPath($kataFile), 'The kata file must exists.');
        }

        /**
         * @When /^The following command is launched:$/
         */
        public function theFollowingCommandIsLaunched(TableNode $table)
        {
//            $command = null;
//            foreach ( as $name => ) {
//
//            }
            $tester = new ApplicationTester($this->application);
            $input = $table->getRowsHash();

            if ($tester->run($input)) {
                var_dump($tester->getDisplay());die("\n\n\nERROR\n\n\n");
            }
        }

        /**
         * @Then /^The \'([^\']*)\' file should be created$/
         */
        public function theFileShouldBeCreated($filename)
        {
            throw new PendingException();
        }

        /**
         * @Given /^The class \'([^\']*)\' should be created$/
         */
        public function theClassShouldBeCreated($class)
        {
            throw new PendingException();
        }

        /**
         * @Given /^The method \'([^\']*)\' should be created$/
         */
        public function theMethodShouldBeCreated($method)
        {
            throw new PendingException();
        }

        /**
         * @Given /^I have the \'([^\']*)\' kata$/
         */
        public function iHaveTheKata($name)
        {
            $this->kata = new Kata($name);
        }

        /**
         * @When /^I start the kata$/
         */
        public function iStartTheKata()
        {
            $this->kata->start();
        }

        /**
         * @Then /^I should have a file named \'([^\']*)\' with content:$/
         */
        public function iShouldHaveAFileNamedWithContent($filename, PyStringNode $content)
        {
            throw new PendingException();
//            assertFileExists($this->getRootPath() . $filename);
//            assertEquals($content->getRaw(), file_get_contents($this->getRootPath() . $filename));
        }
    }
}
