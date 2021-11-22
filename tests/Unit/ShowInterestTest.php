<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\InterestRepository;
use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Adapter\InMemory\Repository\OfferRepository;
use App\Entity\Interest;
use App\UseCase\ShowInterest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

/**
 * Class ShowInterestTest
 * @package App\Tests\Unit
 */
class ShowInterestTest extends TestCase
{
    public function testSuccessfulShowInterest()
    {
        $userPasswordHasher = $this->createMock(UserPasswordHasher::class);
        $userPasswordHasher->method("hashPassword")->willReturn("hash_password");

        $useCase = new ShowInterest(
            new InterestRepository(),
            new OfferRepository(),
            new JobSeekerRepository($userPasswordHasher)
        );

        $this->assertInstanceOf(Interest::class, $useCase->execute(1, 1));
    }
}
