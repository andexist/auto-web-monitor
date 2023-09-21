<?php

namespace App\MessageHandler\Url;

use App\Entity\Url;
use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Message\Url\UrlGeneratorMessage;
use App\Repository\Cache\Redis\RickAndMorty\RickAndMortyCacheRepository;
use App\Service\Url\UrlService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UrlGeneratorMessageHandler
{
    public function __construct(
        private RickAndMortyApiClient $client,
        private UrlService $urlService,
        private RickAndMortyCacheRepository $rickAndMortyCacheRepository
    ) {
    }

    public function __invoke(UrlGeneratorMessage $urlGeneratorMessage)
    {
        $page = $this->rickAndMortyCacheRepository->getPreviousKey() ?? 1;

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
