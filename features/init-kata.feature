Feature:
  As a developer
  I want to keep my programming skills in shape
  So that I can code faster

  Background:
    Given I have the following configuration:
      """
      php_kata:
        src_path: vfs://src
        katas:
          assert-true:
            class: Star\Kata\Data\FibonacciKata
            name: assert-true
      """

  Scenario: Starting the kata creates the test assertions
    Given The 'src' folder is empty
    When I launch the command:
      | command | kata      |
      | start   | fibonacci |
    Then I should have a file 'FibonacciSequence.php' with content:
    """
    <?php
    class FibonacciSequence
    {
        public function getNumber()
        {
        }
    }
    """
    And I should have a file 'FibonacciSequenceTest.php' with content:
    """
    <?php
    class FibonacciSequenceTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var FibonacciSequence
         */
        private $class;

        public function setUp()
        {
            $this->class = new \FibonacciSequence();
        }

        public function testFirstNumberShouldBeZero()
        {
            $this->assertSame(0, $this->class->getNumber());
        }
    }
    """
#
#  Scenario: Compute failed objectives
#    Given The file 'FibonacciSequence.php' contains:
#      """
#      <?php
#      class FibonacciSequence
#      {
#          public function getNumber()
#          {
#          }
#      }
#      """
#    When I launch the command:
#      | command | kata      |
#      | stop    | fibonacci |
#    Then The user should have 0 points
#    And The Objectives should be failed
#
#  Scenario: Compute successful objectives
#    Given The file 'FibonacciSequence.php' contains:
#    """
#      <?php
#      class FibonacciSequence
#      {
#          public function getNumber()
#          {
#              return 0;
#          }
#      }
#      """
#    When I launch the command:
#      | command | kata      |
#      | stop    | fibonacci |
#    Then The user should have 5 points
#    And The Objectives should be successful
