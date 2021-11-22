<?php

namespace App\DataFixtures;

use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * UserFixtures constructor.
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        $jobSeeker = (new JobSeeker())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("job.seeker@email.com");

        $jobSeeker->setPassword($this->userPasswordHasher->hashPassword($jobSeeker, "Password123!"));

        $manager->persist($jobSeeker);

        $recruiter = (new Recruiter())
            ->setFirstName("Jane")
            ->setLastName("Carbon")
            ->setCompanyName("Company")
            ->setEmail("recruiter@email.com");

        $recruiter->setPassword($this->userPasswordHasher->hashPassword($recruiter, "Password123!"));

        $manager->persist($recruiter);

        $manager->flush();
    }
}
