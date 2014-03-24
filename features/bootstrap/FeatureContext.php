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
         * @var KataApplication
         */
        private $application;

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
        }

        /**
         * @Given /^The \'([^\']*)\' folder is empty$/
         */
        public function theFolderIsEmpty($sourceFolder)
        {
            $expected = array('src' => array());
            $structure = vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure();
            assertSame($expected, $structure);
        }

        /**
         * @When /^I launch the command:$/
         */
        public function iLaunchTheCommand(TableNode $table)
        {
            $input = $table->getHash();
            $input = $input[0];

            $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'kata' . DIRECTORY_SEPARATOR . 'php-kata.yml';
            $yamlLoader = new YamlLoader();
            $config = $yamlLoader->load($path);
            $config->setSrcPath(vfsStream::url('src'));

            $this->application = new KataApplication($config);
            $this->application->setAutoExit(false);

            $tester = new ApplicationTester($this->application);
            if ($tester->run($input)) {
                var_dump($tester->getDisplay());die("\n\n\nERROR\n\n\n");
            }
        }

        /**
         * @Then /^I should have a file \'([^\']*)\' with content:$/
         */
        public function iShouldHaveAFileWithContent($filename, PyStringNode $string)
        {
            throw new PendingException();
        }

        /**
         * @Given /^The file \'([^\']*)\' contains:$/
         */
        public function theFileContains($filename, PyStringNode $string)
        {
            throw new PendingException();
        }

        /**
         * @Then /^The user should have (\d+) points$/
         */
        public function theUserShouldHavePoints($points)
        {
            throw new PendingException();
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
    }
}
