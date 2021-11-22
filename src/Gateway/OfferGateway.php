<?php

namespace App\Gateway;

use App\Entity\Offer;

/**
 * Interface OfferGateway
 * @package App\Gateway
 */
interface OfferGateway
{
    public function publish(Offer $offer): void;

    /**
     * @param int $id
     * @return Offer
     */
    public function findOneById(int $id): Offer;
}
