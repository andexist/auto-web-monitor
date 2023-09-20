<?php

namespace App\Command\Url;

use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Service\Url\UrlService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Url;

#[AsCommand(
    name: 'url:generate',
    description: 'Generate random url',
)]
class UrlGeneratorCommand extends Command
{
    public function __construct(
        private RickAndMortyApiClient $client,
        private UrlService $urlService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $charactersListDTO = $this->client->fetchCharacters(1);

        foreach($charactersListDTO->getCharacterDTO() as $characterDTO) {
            $url = new Url();
            $url->setUrl($characterDTO->getImage());
            $this->urlService->persist($url);
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
