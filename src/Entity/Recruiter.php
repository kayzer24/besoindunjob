<?php

namespace App\Entity;

use App\Adapter\Doctrine\Repository\RecruiterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recruiter
 * @package App\Entity
 * @ORM\Entity
 */
class Recruiter extends User
{
    /**
     * @var string|null
     */
    private ?string $companyName = null;

    /**
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string|null $companyName
     * @return Recruiter
     */
    public function setCompanyName(?string $companyName): Recruiter
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getRoles()
    {
        return ["ROLE_USER", "ROLE_RECRUITER"];
    }
}
