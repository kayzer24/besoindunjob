<?php

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;

final class HireContext implements Context
{
    /**
     * @Given I want to hire a job seeker so that supplied for our job offer
     */
    public function iWantToHireAJobSeekerSoThatSuppliedForOurJobOffer(): void
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When I hire him
     */
    public function iHireHim(): void
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then the job is archived
     */
    public function theJobIsArchived(): void
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
