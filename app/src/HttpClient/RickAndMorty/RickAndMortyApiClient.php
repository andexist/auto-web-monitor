<?php

declare(strict_types=1);

namespace App\HttpClient\RickAndMorty;

use App\DTO\RickAndMarty\Character\CharacterDTO;
use App\DTO\RickAndMarty\Character\CharacterListDTO;
use App\DTO\RickAndMarty\MetadataDTO;
use App\Exception\RickAndMorty\RickAndMortyNoNextPageException;
use App\HttpClient\AbstractHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\HttpClient\RickAndMorty\Interface\RickAndMortyApiClientInterface;

class RickAndMortyApiClient extends AbstractHttpClient implements RickAndMortyApiClientInterface
{
    protected static string $characterEndpoint = 'character/';

    public function __construct(protected HttpClientInterface $client)
    {
        $uri = 'https://rickandmortyapi.com/api';
        $headers = [
            'Accept' => 'application/json',
        ];

        parent::__construct($this->client, $uri, $headers);
    }

    public function fetchCharacters(int $page = 1): CharacterListDTO
    {
        $queryParams = [
            'page' => $page
        ];

        $response = $this->fetch('GET', self::$characterEndpoint, $queryParams);

        if ($response->getStatusCode() === 404) {
            throw new RickAndMortyNoNextPageException();
        }

        $charactersData = $response->toArray();
        $characters = [];

        foreach ($charactersData['results'] as $character) {
            $characterDTO = new CharacterDTO(
                $character['id'],
                $character['name'],
                $character['species'],
                $character['location']['name'],
                $character['image']
            );

            $characters[] = $characterDTO;
        }

        return new CharacterListDTO(
            $characters,
            $this->getMetadata($charactersData['info'])
        );
    }

    private function getMetadata(array $metadata): MetadataDTO
    {
        return new MetadataDTO(
            $metadata['count'],
            $metadata['pages'],
            $metadata['next'],
            $metadata['prev'],
        );
    }
}
