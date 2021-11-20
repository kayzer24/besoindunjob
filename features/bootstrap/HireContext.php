<?php

namespace App\Features;

use Behat\Behat\Context\Context;

final class HireContext implements Context
{
    /**
     * @Given I want to hire a job seeker so that supplied for our job offer
     */
    public function iWantToHireAJobSeekerSoThatSuppliedForOurJobOffer(): void
    {
    }

    /**
     * @When I hire him
     */
    public function iHireHim(): void
    {
    }

    /**
     * @Then the job is archived
     */
    public function theJobIsArchived(): void
    {
    }
}
