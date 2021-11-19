<?php

namespace App\Features;

use Behat\Behat\Context\Context;

class MatchContext implements Context
{
    /**
     * @Given /^I want to look for job seekers that match with my job offer$/
     */
    public function iWantToLookForJobSeekersThatMatchWithMyJobOffer()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I select an offer$/
     */
    public function iSelectAnOffer()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^I can see the list of job seekers with the best compatibility with my job offer$/
     */
    public function iCanSeeTheListOfJobSeekersWithTheBestCompatibilityWithMyJobOffer()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
