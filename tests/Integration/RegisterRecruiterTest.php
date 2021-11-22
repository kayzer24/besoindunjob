<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RegisterRecruiterTest
 * @package App\Tests\Integration
 */
class RegisterRecruiterTest extends WebTestCase
{
    public function testSuccessfullRegistration(): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_recruiter")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form([
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[email]" => "email@email.com",
            "registration[plainPassword]" => "Password123!",
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @dataProvider provideBadRequest
     * @param array $formData
     */
    public function testBadRequest(array $formData): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("register_recruiter")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form($formData);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function provideBadRequest(): \Generator
    {
        yield [[
            "registration[email]" => "email@email.com",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "fail",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "",
            "registration[plainPassword]" => "Password123!",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",

        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "",
        ]];

        yield [[
            "registration[email]" => "email@email.com",
            "registration[firstName]" => "John",
            "registration[lastName]" => "Doe",
            "registration[companyName]" => "company",
            "registration[plainPassword]" => "fail",
        ]];
    }
}
