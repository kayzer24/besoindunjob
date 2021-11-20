<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

class RegisterJobSeekerContext implements Context
{
    /***
     * @var RegisterJobSeeker
     */
    private RegisterJobSeeker $registerJobSeeker;

    /**
     * @var JobSeeker
     */
    private JobSeeker $jobSeeker;

    /**
     * @Given /^I need to register to look up for a new job$/
     */
    public function iNeedToRegisterToLookUpForANewJob()
    {
        $this->registerJobSeeker = new RegisterJobSeeker(new JobSeekerRepository());
    }

    /**
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
        $this->jobSeeker = new JobSeeker();
        $this->jobSeeker->setPlainPassword("Password123");
        $this->jobSeeker->setEmail("email@email.com");
        $this->jobSeeker->setFirstName("John");
        $this->jobSeeker->setLastName("Doe");
    }

    /**
     * @Then /^I can log in with my new account$/
     */
    public function iCanLogInWithMyNewAccount()
    {
        Assert::assertEquals($this->jobSeeker, $this->registerJobSeeker->execute($this->jobSeeker));
    }
}
