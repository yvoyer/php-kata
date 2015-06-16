Feature:
  As a Developer
  In order to test my skills
  I need to write code based on objectives

  Background:
    Given The 'assert-true' kata exists
    And The code environment is empty

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
    And The file 'getValue.php' contains the following code
    """
    <?php function getValue() { return true; }
    """
    When I evaluate the kata 'assert-true'
    Then I should see
    """
    Success
    """

  Scenario: User inputs invalid code
    Given The code kata 'assert-true' is started
    And The file 'getValue.php' contains the following code
    """
    <?php function getValue() { return false; }
    """
    When I evaluate the kata 'assert-true'
    Then I should see
    """
    Failure
    """
