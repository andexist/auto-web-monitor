<?php

declare(strict_types=1);

namespace App\Service\Url\Generator\RickAndMorty;

use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Repository\Cache\Redis\RickAndMorty\RickAndMortyCacheRepository;
use App\Service\Url\Generator\Interface\UrlGeneratorInterface;
use App\Service\Url\UrlService;

class RickAndMortyUrlGeneratorService implements UrlGeneratorInterface
{
    public function __construct(
        private RickAndMortyApiClient $httpClient,
        private UrlService $urlService,
        private RickAndMortyCacheRepository $rickAndMortyCacheRepository
    ) {
    }

    public function generateUrl(): string
    {
        return $this->generateUrls()[0];
    }

    public function generateUrls(): array
    {
        $page = (int)$this->rickAndMortyCacheRepository->getPreviousKey() ?? 1;

        $charactersListDTO = $this->httpClient->fetchCharacters($page);
        $next = $charactersListDTO->getMetadataDTO()->getNext();
        $nextPage = (int) filter_var($next, FILTER_SANITIZE_NUMBER_INT);
        $key = (string)$nextPage;

        $this->rickAndMortyCacheRepository->setPreviousKey($key);
        $urls = [];

        foreach ($charactersListDTO->getCharacterDTO() as $characterDTO) {
            $urls[] = $characterDTO->getImage();
        }

        return $urls;
    }
}
