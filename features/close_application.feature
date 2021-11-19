Feature: Close application
  Scenario: As a recruiter I want to close an application that I can stop the recruitment
    Given I want to close an application
    When I close it
    Then the recruitment process is stopped