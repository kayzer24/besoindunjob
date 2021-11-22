<?php

namespace App\UseCase;

use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;
use Assert\Assert;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class RegisterJobSeeker
 * @package App\UseCase
 */
class RegisterJobSeeker
{
    /**
     * @var JobSeekerGateway
     */
    private JobSeekerGateway $jobSeekerGateway;

    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $userPasswordHasher;

    /**
     * RegisterJobSeeker constructor.
     * @param JobSeekerGateway $jobSeekerGateway
     * @param UserPasswordHasherInterface $userPasswordHasher
     */
    public function __construct(
        JobSeekerGateway $jobSeekerGateway,
        UserPasswordHasherInterface $userPasswordHasher
    ) {
        $this->jobSeekerGateway = $jobSeekerGateway;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param JobSeeker $jobSeeker
     * @return JobSeeker
     */
    public function execute(JobSeeker $jobSeeker): JobSeeker
    {
        Assert::lazy()
            ->that($jobSeeker->getFirstName(), 'firstName')->notBlank()
            ->that($jobSeeker->getLastName(), 'lastName')->notBlank()
            ->that($jobSeeker->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->regex(
                    "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
                )
            ->that($jobSeeker->getEmail(), 'email')
                ->notBlank()
                ->email()
            ->verifyNow()
            ;

        $jobSeeker->setPassword(
            $this->userPasswordHasher->hashPassword($jobSeeker, $jobSeeker->getPlainPassword())
        );

        $this->jobSeekerGateway->register($jobSeeker);

        return $jobSeeker;
    }
}
