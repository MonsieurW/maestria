Feature: admin

  Scenario: Main page
    When I login as admin
    Then I should see "Administrateur"
    Then I should see "Libero minus impedit in vel et voluptas."
    Then I should see "Repellendus vitae possimus illum nobis iure."
    Then I should see an ".fa-archive" element
    Then I should see an ".fa-plus-circle" element

  Scenario: Evaluate page
    When I login as admin
    Given I am on "/evalute/7"
    Then I should see "Illo omnis autem sed tenetur."
