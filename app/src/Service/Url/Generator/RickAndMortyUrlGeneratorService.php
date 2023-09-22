<?php

declare(strict_types=1);

namespace App\Service\Url\Generator;

use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Repository\Cache\Redis\RickAndMorty\RickAndMortyCacheRepository;
use App\Service\Url\UrlService;
use App\Entity\Url;
use App\Service\Url\Interface\UrlGeneratorInterface;

class RickAndMortyUrlGeneratorService implements UrlGeneratorInterface
{
    public function __construct(
        private RickAndMortyApiClient $client,
        private UrlService $urlService,
        private RickAndMortyCacheRepository $rickAndMortyCacheRepository
    ) {
    }

    public function generateUrl()
    {
        $page = (int)$this->rickAndMortyCacheRepository->getPreviousKey() ?? 1;

        $charactersListDTO = $this->client->fetchCharacters($page);
        $next = $charactersListDTO->getMetadataDTO()->getNext();
        $nextPage = (int) filter_var($next, FILTER_SANITIZE_NUMBER_INT);
        $key = (string)$nextPage;

        $this->rickAndMortyCacheRepository->setPreviousKey($key);

        foreach ($charactersListDTO->getCharacterDTO() as $characterDTO) {
            $url = new Url();
            $url->setUrl($characterDTO->getImage());
            $this->urlService->persist($url);
        }
    }
}
