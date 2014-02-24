<?php

namespace {
    use Behat\Behat\Context\ClosuredContextInterface,
        Behat\Behat\Context\TranslatedContextInterface,
        Behat\Behat\Context\BehatContext,
        Behat\Behat\Exception\PendingException;
    use Behat\Gherkin\Node\PyStringNode,
        Behat\Gherkin\Node\TableNode;
    use features\bootstrap\TestCommand;
    use Star\Kata\KataApplication;
    use Symfony\Component\Console\Tester\ApplicationTester;

    require_once 'PHPUnit/Autoload.php';
    require_once 'PHPUnit/Framework/Assert/Functions.php';

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
         * Initializes context.
         * Every scenario gets it's own context object.
         *
         * @param array $parameters context parameters (set them up through behat.yml)
         */
        public function __construct(array $parameters)
        {
            $this->application = new KataApplication($this->getRootPath());
            $this->application->setAutoExit(false);
        }

        /**
         * @return string
         */
        private function getRootPath()
        {
            return dirname(__DIR__) . DIRECTORY_SEPARATOR;
        }

        /**
         * @param string $filename
         *
         * @return string
         */
        private function getKataPath($filename = null)
        {
            return $this->getRootPath() . 'data' . DIRECTORY_SEPARATOR . $filename;
        }

        /**
         * @return string
         */
        private function getSrcPath()
        {
            return $this->getRootPath() . 'src' . DIRECTORY_SEPARATOR;
        }

        /**
         * @Given /^I have the \'([^\']*)\' configuration$/
         */
        public function iHaveTheConfiguration($kataFile)
        {
            assertFileExists($this->getKataPath($kataFile), 'The kata file must exists.');
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
            var_dump($input);
            if ($tester->run($input)) {
                var_dump($tester->getDisplay());die("\n\n\nERROR\n\n\n");
            }
        }

        /**
         * @Then /^The \'([^\']*)\' file should be created$/
         */
        public function theFileShouldBeCreated($filename)
        {
            assertFileExists($this->getSrcPath() . $filename, 'The src file should be generated');
        }

        /**
         * @Given /^The class \'([^\']*)\' should be created$/
         */
        public function theClassShouldBeCreated($class)
        {
            var_dump($class);
        }

        /**
         * @Given /^The method \'([^\']*)\' should be created$/
         */
        public function theMethodShouldBeCreated($method)
        {
            var_dump($method);
        }
    }
}
