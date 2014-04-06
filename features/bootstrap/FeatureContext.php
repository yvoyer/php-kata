<?php

namespace {
    use Behat\Behat\Context\ClosuredContextInterface,
        Behat\Behat\Context\TranslatedContextInterface,
        Behat\Behat\Context\BehatContext,
        Behat\Behat\Exception\PendingException;
    use Behat\Gherkin\Node\PyStringNode,
        Behat\Gherkin\Node\TableNode;
    use org\bovigo\vfs\vfsStream;
    use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
    use Star\Kata\Configuration\Configuration;
    use Star\Kata\Configuration\YamlLoader;
    use Star\Kata\KataApplication;
    use Star\Kata\Model\Kata;
    use Symfony\Component\Console\Input\ArgvInput;
    use Symfony\Component\Console\Tester\ApplicationTester;
    use Symfony\Component\Yaml\Yaml;

    /**
     * Features context.
     */
    class FeatureContext extends BehatContext
    {
        /**
         * @var ApplicationTester
         */
        private $applicationTester;

        /**
         * @var Configuration
         */
        private $config;

        /**
         * Initializes context.
         * Every scenario gets it's own context object.
         *
         * @param array $parameters context parameters (set them up through behat.yml)
         */
        public function __construct(array $parameters)
        {
            vfsStream::setup('src');
        }

        /**
         * @Given /^I have the following configuration:$/
         */
        public function iHaveTheFollowingConfiguration(PyStringNode $string)
        {
            $this->config = new Configuration();
            $this->config->load(Yaml::parse($string));
            $application = new KataApplication($this->config);
            $application->setAutoExit(false);

            $this->applicationTester = new ApplicationTester($application);
        }

        /**
         * @Given /^The \'([^\']*)\' folder is empty$/
         */
        public function theFolderIsEmpty($sourceFolder)
        {
            $expected = array($sourceFolder => array());
            $structure = $this->getStructure();
            assertSame($expected, $structure);
        }

        /**
         * @When /^I launch the command:$/
         */
        public function iLaunchTheCommand(TableNode $table)
        {
            foreach ($table->getHash() as $input) {
                $this->executeCommand($input);
            }
        }

        /**
         * @Then /^I should have a file \'([^\']*)\' with content:$/
         */
        public function iShouldHaveAFileWithContent($filename, PyStringNode $content)
        {
            $structure = $this->getStructure();

            assertArrayHasKey('src', $structure, 'The src folder should be present');
            assertArrayHasKey($filename, $structure['src'], 'The file should be present');
            assertSame($content->getRaw(), $structure['src'][$filename], 'The content of file ' . $filename . ' should be present');
        }

        /**
         * @Given /^The kata \'([^\']*)\' is started$/
         */
        public function theKataIsStarted($kata)
        {
            $this->executeCommand(array('command' => 'start', 'kata' => $kata));
        }

        /**
         * @Given /^The file \'([^\']*)\' contains:$/
         */
        public function theFileContains($filename, PyStringNode $string)
        {
            file_put_contents(vfsStream::url('src') . '/' . $filename, $string->getRaw());
            require_once(vfsStream::url('src') . '/' . $filename);
        }

        /**
         * @Then /^The user should have (\d+) points$/
         */
        public function theUserShouldHavePoints($points)
        {
            assertContains($points . ' points', $this->applicationTester->getDisplay());
        }

        /**
         * @Given /^The Objectives should be failed$/
         */
        public function theObjectivesShouldBeFailed()
        {
            throw new PendingException();
        }

        /**
         * @Given /^The Objectives should be successful$/
         */
        public function theObjectivesShouldBeSuccessful()
        {
            throw new PendingException();
        }

        /**
         *
         * @return mixed
         */
        private function getStructure()
        {
            return vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure();
        }

        /**
         * @param $input
         */
        private function executeCommand($input)
        {
            if ($this->applicationTester->run($input)) {
                var_dump($this->applicationTester->getDisplay());
                die("\n\n\nERROR\n\n\n");
            }
        }
    }
}
