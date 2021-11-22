<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\RecruiterRepository;
use App\Entity\Recruiter;
use App\UseCase\RegisterRecruiter;
use Behat\Behat\Context\Context;
use Assert\Assertion;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegisterRecruiterContext implements Context
{
    /**
     * @var RegisterRecruiter
     */
    private RegisterRecruiter $registerRecruiter;

    /**
     * @var Recruiter
     */
    private Recruiter $recruiter;
    /**
     * @Given /^I need to register to recruit new employees$/
     */
    public function iNeedToRegisterToRecruitNewEmployees()
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

        $this->registerRecruiter = new RegisterRecruiter(
            new RecruiterRepository($userPasswordHasher),
            $userPasswordHasher
        );
    }

    /**
     * @When /^I fill the registration form as a recruiter$/
     */
    public function iFillTheRegistrationFormAsARecruiter()
    {
        $this->recruiter = new Recruiter();
        $this->recruiter->setFirstName("John")
            ->setLastName("Doe")
            ->setCompanyName("Company")
            ->setEmail("email@email.com")
            ->setPlainPassword("Password123!")
            ;
    }

    /**
     * @Then /^I can log in with my new recuiter account$/
     */
    public function iCanLogInWithMyNewRecuiterAccount()
    {
        Assertion::eq($this->recruiter, $this->registerRecruiter->execute($this->recruiter));
    }
}
