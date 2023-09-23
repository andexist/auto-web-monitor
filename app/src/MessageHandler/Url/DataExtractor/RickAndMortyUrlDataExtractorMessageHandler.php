<?php

declare(strict_types=1);

namespace App\MessageHandler\Url\DataExtractor;

use App\Service\Url\UrlService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Message\Url\DataExtractor\RickAndMortyUrlDataExtractorMessage;
use App\Service\Url\DataExtractor\RickAndMorty\RickAndMortyUrlDataExtractorService;

#[AsMessageHandler]
final class RickAndMortyUrlDataExtractorMessageHandler
{
    public function __construct(
        private RickAndMortyUrlDataExtractorService $urlDataExtractor,
        private UrlService $urlService
    ) {
    }

    public function __invoke(RickAndMortyUrlDataExtractorMessage $urlDataExtractorMessage)
    {
        $urls = $this->urlService->findUrlsWithEmptyFields();

        foreach ($urls as $url) {
            $urlDataDTO = $this->urlDataExtractor->extractUrlData($url->getUrl());
            $url->setStatusCode($urlDataDTO->getStatusCode());
            $url->setRedirectsCount($urlDataDTO->getRedirectsCount());
            $url->setPossibleKeywords($urlDataDTO->getPossibleKeywords());
            $this->urlService->persist($url);
        }
    }
}
