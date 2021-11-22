<?php

declare(strict_types=1);

namespace App\Security\Provider;

use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Gateway\UserGateway;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider
 * @package App\Security\Provider
 * @method UserInterface loadUserByIdentifier(string $identifier)
 */
class UserProvider implements UserProviderInterface
{
    /**
     * @var UserGateway
     */
    private UserGateway $userGateway;

    /**
     * UserProvider constructor.
     * @param UserGateway $userGateway
     */
    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->getUserByUsername($user->getUserIdentifier());
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername(string $username)
    {
        return $this->getUserByUsername($username);
    }

    /**
     * @param string $username
     * @return User
     */
    private function getUserByUsername(string $username): User
    {
        return $this->userGateway->findByEmail($username);
    }

    public function supportsClass(string $class)
    {
        return $class === Recruiter::class || $class === JobSeeker::class;
    }
}
