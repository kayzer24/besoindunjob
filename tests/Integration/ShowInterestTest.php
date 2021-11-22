<?php

namespace App\Tests\Integration;

use App\Gateway\JobSeekerGateway;
use App\Gateway\OfferGateway;
use App\Tests\AuthenticationTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ShowInterestTest
 * @package App\Tests\Integration
 */
class ShowInterestTest extends WebTestCase
{
    use AuthenticationTrait;

    protected function getOffer()
    {
        /** @var OfferGateway $offerRepository */
        $offerRepository = static::getContainer()->get('app.gateway.offer');
        $offer = $offerRepository->findOneById(1);

        return $offer;
    }

    protected function getJobSeeker()
    {
        /** @var JobSeekerGateway $jobSeekerRepository */
        $jobSeekerRepository = static::getContainer()->get('app.gateway.job_seeker');
        $jobSeeker = $jobSeekerRepository->findOneById(1);

        return $jobSeeker;
    }

    public function testSuccessfulShowInterest(): void
    {
        $client = static::createAuthenticatedClient("recruiter@email.com");

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(
            Request::METHOD_GET,
            $router->generate("show_interest", [
                "offer" => $this->getOffer()->getId(),
                "jobSeeker" => $this->getJobSeeker()->getId()
            ])
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
