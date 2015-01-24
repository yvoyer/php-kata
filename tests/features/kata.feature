Feature:
  As a Developer
  In order to test my skills
  I need to write code based on objectives

  Background:
    Given The kata name is 'assert-true'
    And The test requirement code for 'assert-true' kata should be
    """
    $this->assertTrue(assert-true());
    """
    And The 'assert-true' kata objective is "Assert that a function named 'assert-true()' always returns true."

  Scenario: User starts the kata
    Given the kata 'assert-true' was never started
    When I launch the kata 'assert-true'
    Then I should see 'Objective: Assert that a function named 'assert-true()' always returns true.'
    And I should be prompt to enter the php code

  Scenario: User inputs a valid input
    Given The kata 'assert-true' is started
    And I fill the following code
    """
    function assert-true() { return true; }
    """
    When I finish the kata 'assert-true'
    Then I should see a 'passing' test
    And The following message should be visible 'Congratulation, the kata was successful.'

  Scenario: User finishes the kata with no defined function
    Given The kata 'assert-true' is started
    And I fill the following code
    """
    function invalid() { return true; }
    """
    When I finish the kata 'assert-true'
    Then I should see a 'failing' test
    And The following message should be visible 'Failed asserting that the 'assert-true' method was called'

  Scenario: User do not calls the kata method
    Given The kata 'assert-true' is started
    And I fill the following code
    """
    function assert-true() { return false; }
    """
    When I finish the kata 'assert-true'
    Then I should see a 'failing' test
    And  The following message should be visible 'Failed asserting the false equals true'
