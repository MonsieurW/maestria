Feature: admin

  Scenario: Main page
    When I login as admin
    Then I should see "Administrateur"
    Then I should see an ".well" element

  Scenario: Evaluate page
    When I login as admin
    Given I am on "/evaluate/1"
    Then I should see an "#sClass" element
    Then I should see an "#fSend" element
