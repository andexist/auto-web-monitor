<?php

declare(strict_types=1);

namespace App\MessageHandler\Url\Generator;

use App\Entity\Url;
use App\Message\Url\Generator\RickAndMortyUrlGeneratorMessage;
use App\Service\Url\Generator\RickAndMorty\RickAndMortyUrlGeneratorService;
use App\Service\Url\UrlService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class RickAndMortyUrlGeneratorMessageHandler
{
    public function __construct(
        private RickAndMortyUrlGeneratorService $urlGeneratorService,
        private UrlService $urlService
    ) {
    }

    public function __invoke(RickAndMortyUrlGeneratorMessage $urlGeneratorMessage)
    {
        $urls = $this->urlGeneratorService->generateUrls();

        foreach($urls as $url) {
            $entity = new Url();
            $entity->setUrl($url);
            $this->urlService->persist($entity);
        }
    }
}
