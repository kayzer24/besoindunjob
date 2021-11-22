<?php

namespace App\Tests\Integration;

use App\Entity\Recruiter;
use App\Gateway\UserGateway;
use App\Tests\AuthenticationTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class PublishOfferTest
 * @package App\Tests\Integration
 */
class PublishOfferTest extends WebTestCase
{
    use AuthenticationTrait;

    public function testSuccessfulPublishOffer(): void
    {
        $client = static::createAuthenticatedClient("recruiter@email.com");

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("publish_offer")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form([
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
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
        $client = static::createAuthenticatedClient("recruiter@email.com");

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("publish_offer")
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $form = $crawler->filter("form")->form($formData);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function provideBadRequest(): \Generator
    {
        yield [[
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[softSkills]" => "soft skills",
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[tasks]" => "tasks",
        ]];

        yield [[
            "offer[name]" => "name",
            "offer[companyDescription]" => "company descriprion",
            "offer[jobDescription]" => "job descriprion",
            "offer[maxSalary]" => 38000,
            "offer[minSalary]" => 32000,
            "offer[missions]" => "missions",
            "offer[profile]" => "profile",
            "offer[remote]" => true,
            "offer[softSkills]" => "soft skills",
        ]];
    }
}
