Feature: Delete offer
  Scenario: As a recruiter I want to delete an existing offer so that job seeker can not apply for the job
    Given I want to delete an offer
    When I select the offer to delete it
    Then Job seekers will no longer be able to apply for the job offer