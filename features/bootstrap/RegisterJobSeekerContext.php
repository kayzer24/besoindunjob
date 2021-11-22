<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use Behat\Behat\Context\Context;
use Assert\Assertion;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
        $userPasswordHasher = new class () implements UserPasswordHasherInterface
        {
            public function hashPassword(UserInterface $user, string $plainPassword)
            {
                return "hash_password";
            }

            public function isPasswordValid(UserInterface $user, string $raw)
            {
            }

            public function needsRehash(UserInterface $user): bool
            {
            }
        };
        $this->registerJobSeeker = new RegisterJobSeeker(
            new JobSeekerRepository($userPasswordHasher),
            $userPasswordHasher
        );
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
        Assertion::eq($this->jobSeeker, $this->registerJobSeeker->execute($this->jobSeeker));
    }
}
