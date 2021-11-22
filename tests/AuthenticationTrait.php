<?php

namespace App\Tests;

use App\Gateway\UserGateway;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

/**
 * Class AuthenticationTrait
 * @package App\Tests
 */
trait AuthenticationTrait
{
    /**
     * @param string $email
     * @return KernelBrowser
     */
    public static function createAuthenticatedClient(string $email): KernelBrowser
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserGateway::class);
        $testUser = $userRepository->findByEmail($email);

        $client->loginUser($testUser);

        return $client;
    }
}
