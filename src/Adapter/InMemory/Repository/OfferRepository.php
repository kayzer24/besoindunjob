<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Offer;
use App\Gateway\OfferGateway;

class OfferRepository implements OfferGateway
{
    /**
     * @var Offer[]
     */
    public array $offers = [];

    public function __construct()
    {
        $offer = (new Offer())
            ->setName("name")
            ->setCompanyDescription("company descriprion")
            ->setJobDescription("job descriprion")
            ->setMinSalary(32000)
            ->setMaxSalary(38000)
            ->setMissions("missions")
            ->setProfile("profile")
            ->setRemote(true)
            ->setSoftSkills("soft skills")
            ->setTasks("tasks");

        $reflexionClass = new \ReflectionClass($offer);
        $reflexionProperty = $reflexionClass->getProperty("id");
        $reflexionProperty->setAccessible(true);
        $reflexionProperty->setValue($offer, 1);

        $this->offers = [1 => $offer];
    }

    public function publish(Offer $offer): void
    {
    }

    public function findOneById(int $id): Offer
    {
        return $this->offers[$id];
    }
}
