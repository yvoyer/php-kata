Feature:
  As a Developer
  In order to test my skills
  I need to write code based on objectives

  Background:
    Given The 'assert-true' kata exists

  Scenario: User starts the kata
    Given The code environment is empty
    When I start the kata 'assert-true'
    Then I should see
    """
    Kata: assert-true
    Description: Always return true

    """

  Scenario: User inputs a valid code
    Given The code kata 'assert-true' is started
    And The file 'AssertTrue.php' contains the following code
    """
    <?php
    class AssertTrue
    {
        public static function getValue()
        {
            return true;
        }
    }
    """
    When I evaluate the kata 'assert-true'
    Then I should see
    """
    Objective: Always return true
    You finished all the objectives, 3 points awarded.

    """

  Scenario: User inputs invalid code
    Given The code kata 'assert-true' is started
    And The file 'AssertTrue.php' contains the following code
    """
    <?php
    class AssertTrue
    {
        public static function getValue()
        {
            return false;
        }
    }
    """
    When I evaluate the kata 'assert-true'
    Then I should see
    """
    Objective: Always return true
    You failed 2/3 objectives, 2 points awarded. Keep trying.

    """
