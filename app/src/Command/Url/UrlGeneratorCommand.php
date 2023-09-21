<?php

declare(strict_types=1);

namespace App\Command\Url;

use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Service\Url\UrlService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Url;
use App\Repository\Cache\Redis\RickAndMorty\RickAndMortyCacheRepository;

#[AsCommand(
    name: 'url:generate',
    description: 'Generate random url',
)]
class UrlGeneratorCommand extends Command
{
    public function __construct(
        private RickAndMortyApiClient $client,
        private UrlService $urlService,
        private RickAndMortyCacheRepository $rickAndMortyCacheRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

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

        $io->success('Done inserting url\'s');

        return Command::SUCCESS;
    }
}
