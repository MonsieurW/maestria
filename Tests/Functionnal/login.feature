Feature: login

  Scenario: First login on homepage with fail information
    Given I am on "/logout"
    Then I should see "Ask an administrator for register into the application thank you."
    Given I am on "/"
    Then I should see "Ask an administrator for register into the application thank you."
    When I am login with user "Foo" password "Bar"
    Then I should see "Something went wrong"
    Then show last response
    When I am login with user "admin" password "admin"
    Then I should see "Administrator"
