<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\InterestRepository;
use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Adapter\InMemory\Repository\OfferRepository;
use App\Entity\Interest;
use App\UseCase\ShowInterest;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowInterestContext implements Context
{
    /**
     * @var ShowInterest
     */
    private ShowInterest $showInterest;

    /**
     * @var int
     */
    private int $offer;

    /**
     * @var int
     */
    private int $jobSeeker;

    /**
     * @Given /^I want to show interest for a job seeker$/
     */
    public function iWantToShowInterestForAJobSeeker()
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

        $this->showInterest = new ShowInterest(
            new InterestRepository(),
            new OfferRepository(),
            new JobSeekerRepository($userPasswordHasher)
        );
    }

    /**
     * @When /^I send my interest to the job seeker$/
     */
    public function iSendMyInterestToTheJobSeeker()
    {
        $this->offer = 1;

        $this->jobSeeker = 1;
    }

    /**
     * @Then /^the job seeker is aware of out interest$/
     */
    public function theJobSeekerIsAwareOfOutInterest()
    {
        Assertion::isInstanceOf($this->showInterest->execute($this->offer, $this->jobSeeker), Interest::class);
    }
}
