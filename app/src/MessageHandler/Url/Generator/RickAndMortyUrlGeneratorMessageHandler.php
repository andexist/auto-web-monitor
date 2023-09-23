<?php

declare(strict_types=1);

namespace App\MessageHandler\Url\Generator;

use App\Message\Url\Generator\RickAndMortyUrlGeneratorMessage;
use App\Service\Url\Generator\RickAndMorty\RickAndMortyUrlGeneratorService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class RickAndMortyUrlGeneratorMessageHandler
{
    public function __construct(
        private RickAndMortyUrlGeneratorService $urlGeneratorService
    ) {
    }

    public function __invoke(RickAndMortyUrlGeneratorMessage $urlGeneratorMessage)
    {
        $this->urlGeneratorService->generateUrl();
    }
}
