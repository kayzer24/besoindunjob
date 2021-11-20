Feature: Register Job Seeker
  Scenario: As a job seeker I want to register so that I look for new job
    Given I need to register to look up for a new job
    When I fill the registration form
    Then I can log in with my new account