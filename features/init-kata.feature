Feature:
  As a developer
  I want to keep my programming skills in shape
  So that I can code faster

#  Scenario: Create the skeleton based on kata file
#    Given I have the 'db.kata' configuration
#    When The following command is launched:
#      | command | init |
#      | kata | test |
#    Then The 'Test.php' file should be created
#    And The class 'Test' should be created
#    And The method 'Test::getValue' should be created

  Scenario: Generate a src file
    Given I have the 'assert-true' kata
    When I start the kata
    Then I should have a file named 'AssertTrue.php' with content:
      """
      <?php
      class AssertTrue
      {
      }
      """