<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;

class ShowInterestContext implements Context
{
    /**
     * @Given /^I want to show interest for a job seeker$/
     */
    public function iWantToShowInterestForAJobSeeker()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I send my interest to the job seeker$/
     */
    public function iSendMyInterestToTheJobSeeker()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^the job seeker is aware of out interest$/
     */
    public function theJobSeekerIsAwareOfOutInterest()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
