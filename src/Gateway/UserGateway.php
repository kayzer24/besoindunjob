<?php

namespace App\Gateway;

use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface UserGateway
 * @package App\Gateway
 */
interface UserGateway
{
    /**
     * @param string $email
     * @return UserInterface|null
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): ?UserInterface;
}
