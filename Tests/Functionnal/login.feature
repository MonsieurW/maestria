Feature: login

  Scenario: First login on homepage with fail information
    Given I am on "/logout"
    Then I should see "Ask an administrator for register into the application thank you."
    Given I am on "/"
    Then I should see "Ask an administrator for register into the application thank you."
    When I am login with user "Foo" password "Bar"
    Then I should see "Something went wrong"

  Scenario: Admin information
    Given I am on "/logout"
    Given I am on "/"
    When I am login with user "admin" password "admin"
    Given I am on "/"
    Then I should see "Administrateur"
    Then I should see an ".fa-bookmark" element
    Then I should see an ".fa-desktop" element
    Then I should see an ".fa-road" element
    Then I should see an ".fa-paw" element
    Then I should see an ".fa-plus-circle" element
    Given I am on "/user/1/edit"
    Then I should see "Classroom"
    And I should see "Domain"
    And I should see "ACL"
    Given I am on "/user/4/edit"
    Then I should see "Password"
    And I should see "Classroom"
    And I should see "Domain"
    And I should see "ACL"
    Given I am on "/user/1/"
    Then I should see "Administrateur"
    And I should see "Administrator"
    And I should not see "Professor"
    And I should see "Moderator"
    And I should see "admin"
    And I should see "1°L"
    And I should see "1°S"
    And I should see "1°ES"

  # TODO :  Rebuild mod ACL
  Scenario: Moderator information
    Given I am on "/logout"
    Given I am on "/"
    When I am login with user "mod" password "mod"
    Given I am on "/"
    Then I should see "Moderator"
    Then I should not see an ".fa-bookmark" element
    Then I should not see an ".fa-desktop" element
    Then I should not see an ".fa-road" element
    Then I should not see an ".fa-paw" element
    Then I should not see an ".fa-plus-circle" element
    Given I am on "/user/2/edit"
    Then I should see "Password"
    Given I am on "/user/2/"
    Then I should see "Moderator"
    And I should see "Moderator"
    And I should not see "Administrator"
    And I should not see "Professor"
    And I should see "mod"
    And I should see "T°L"
    And I should see "T°S"
    And I should see "T°ES"

  # TODO : Rebuild mod ACL
  # TODO : No classroom per default
  Scenario: Professor information
    Given I am on "/logout"
    Given I am on "/"
    When I am login with user "prof" password "prof"
    Given I am on "/"
    Then I should see "Professor"
    Then I should not see an ".fa-bookmark" element
    Then I should not see an ".fa-desktop" element
    Then I should not see an ".fa-road" element
    Then I should not see an ".fa-paw" element
    Given I am on "/user/3/edit"
    Then I should see "Password"
    And I should see "Classroom"
    And I should see "Domain"
    Given I am on "/user/3/"
    Then I should see "Professor"
    And I should not see "Administrator"
    And I should see an ".glyphicon-question-sign" element
    And I should see "prof"

  # TODO : Rebuild mod ACL
  # TODO : No classroom per default
  Scenario: Eleve information
    Given I am on "/logout"
    Given I am on "/"
    When I am login with user "eleve" password "eleve"
    Given I am on "/"
    Then I should see "Eleve"
    Then I should not see an ".fa-bookmark" element
    Then I should not see an ".fa-desktop" element
    Then I should not see an ".fa-road" element
    Then I should not see an ".fa-paw" element
    Given I am on "/user/4/edit"
    Then I should see "Password"
    Given I am on "/user/4/"
    Then I should see "Eleve"
    And I should not see "Administrator"
    And I should not see "Professor"
    And I should not see "Moderator"
    And I should not see an ".glyphicon-question-sign" element
    And I should see "eleve"
