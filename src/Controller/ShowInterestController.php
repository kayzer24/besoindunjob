<?php

namespace App\Controller;

use App\UseCase\ShowInterest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ShowInterestController
 * @package App\Controller
 */
class ShowInterestController
{
    /**
     * @var ShowInterest
     */
    private ShowInterest $showInterest;
    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface $urlGenerator;

    /**
     * ShowInterestController constructor.
     * @param ShowInterest $showInterest
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        ShowInterest $showInterest,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->showInterest = $showInterest;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param int $offer
     * @param int $jobSeeker
     * @return RedirectResponse
     */
    public function __invoke(int $offer, int $jobSeeker)
    {
        $this->showInterest->execute($offer, $jobSeeker);

        return new RedirectResponse($this->urlGenerator->generate("index"));
    }
}
