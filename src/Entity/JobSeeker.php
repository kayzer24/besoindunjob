<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class JobSeeker
 * @package App\Entity
 * @ORM\Entity
 */
class JobSeeker extends User
{
    public function getRoles()
    {
        return ["ROLE_USER", "ROLE_JOB_SEEKER"];
    }
}
