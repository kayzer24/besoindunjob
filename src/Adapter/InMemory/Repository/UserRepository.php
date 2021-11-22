<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Gateway\UserGateway;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 * @package App\Adapter\InMemory\Repository
 */
class UserRepository implements UserGateway
{
    /**
     * @var User[]
     */
    public array $users = [];

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $jobSeeker = (new JobSeeker())
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("job.seeker@email.com");

        $jobSeeker->setPassword($userPasswordHasher->hashPassword($jobSeeker, "Password123!"));

        $recruiter = (new Recruiter())
            ->setFirstName("Jane")
            ->setLastName("Carbon")
            ->setCompanyName("Company")
            ->setEmail("recruiter@email.com");

        $recruiter->setPassword($userPasswordHasher->hashPassword($recruiter, "Password123!"));

        $this->users = [
            "job.seeker@email.com" => $jobSeeker,
            "recruiter@email.com" => $recruiter
        ];
    }

    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UserNotFoundException();
        }

        return $this->users[$email];
    }
}
