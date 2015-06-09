Feature: Select a kata to start
  As a user
  I order to practice a kata
  I need to choose from the available katas

  Background:
    Given The kata registry contains kata 0
    """
--TEST--
Assert true
--FILE--
<?php
###USER_INPUT###
var_dump(assertTrueKata());
?>
--EXPECT--
bool(true)
"""

  Scenario: Run the kata with valid input
    Given I run the kata '0' with user inputs
    """
function assertTrueKata()
{
    return true;
}
    """
    Then There should be 0 failures
    And The test should be successful

  Scenario: Run the kata with invalid code
    Given I run the kata '0' with user inputs
    """
function assertTrueKata()
{
    return false;
}
    """
    Then There should be 1 failures
    And The test should be failed

  Scenario: Run the kata with code containing errors
    Given I run the kata '0' with user inputs
    """
    """
    Then There should be 1 failures
    And The test should be failed
