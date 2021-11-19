<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;

class PublishOfferContext implements Context
{
    /**
     * @Given /^I want to publish an offer$/
     */
    public function iWantToPublishAnOffer()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I write the offer$/
     */
    public function iWriteTheOffer()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^The offer is published and the job seeker can send their application for a new job$/
     */
    public function theOfferIsPublishedAndTheJobSeekerCanSendTheirApplicationForANewJob()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
