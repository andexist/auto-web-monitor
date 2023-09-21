<?php

declare(strict_types=1);

namespace App\Command\Url;

use App\Service\Url\UrlDataExtractorService;
use App\Service\Url\UrlService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'url:extract-data',
    description: 'Extract url data',
)]
class UrlDataExtractorCommand extends Command
{
    public function __construct(
        private UrlDataExtractorService $urlDataExtractorService,
        private UrlService $urlService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        foreach ($this->urlService->findALl() as $urlEntity) {
            $urlDataDTO = $this->urlDataExtractorService->extractUrlData($urlEntity->getUrl());
            $urlEntity->setStatusCode($urlDataDTO->getStatusCode());
            $urlEntity->setRedirectsCount($urlDataDTO->getRedirectsCount());
            $urlEntity->setPossibleKeywords($urlDataDTO->getPossibleKeywords());
            $this->urlService->persist($urlEntity);
        }

        $io->success('Done updating url entity');

        return Command::SUCCESS;
    }
}
