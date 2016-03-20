Feature:
  As a Developer
  In order to test my skills
  I need to write code based on objectives

  Background:
    # add provider for list of kata
    Given The 'assert-true' kata exists
    And The 'assert-false' kata exists
    And The code environment is empty

  Scenario: User starts the kata
    When I start the kata 'assert-true'
    Then I should see
    """
    Kata: assert-true
    Description: Always return true

    """
    And The current kata should be defined as 'assert-true'

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
    And The current kata data should be removed.

  Scenario: User inputs invalid code
    Given The code kata 'assert-false' is started
    And The file 'AssertFalse.php' contains the following code
    """
    <?php
    class AssertFalse
    {
        public static function getValue()
        {
            return false;
        }
    }
    """
    When I evaluate the kata 'assert-false'
    Then I should see
    """
    Objective: Always return false
    You succeed 2/3 objectives, 2 points awarded. Keep trying.

    """
    And The current kata data should be removed.
