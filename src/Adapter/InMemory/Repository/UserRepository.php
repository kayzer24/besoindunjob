<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\User;
use App\Gateway\UserGateway;

/**
 * Class UserRepository
 * @package App\Adapter\InMemory\Repository
 */
abstract class UserRepository implements UserGateway
{
}
