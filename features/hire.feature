Feature: Hire
  Scenario: As a recruiter I want to hire a job seeker that I can archive my job offer
    Given I want to hire a job seeker so that supplied for our job offer
    When I hire him
    Then the job is archived