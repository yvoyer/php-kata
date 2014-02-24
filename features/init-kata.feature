Feature:
  As a developer
  I want to keep my programming skills in shape
  So that I can code faster

  Scenario: Create the skeleton based on kata file
    Given I have the 'db.kata' configuration
    When The following command is launched:
    | command | init |
    | kata | test |
    Then The 'Test.php' file should be created
    And The class 'Test' should be created
    And The method 'Test::getValue' should be created