<?php

declare(strict_types=1);

namespace App\Tests\Unit\Url;

use App\DTO\RickAndMarty\Character\CharacterDTO;
use App\DTO\RickAndMarty\Character\CharacterListDTO;
use App\DTO\RickAndMarty\MetadataDTO;
use App\HttpClient\RickAndMorty\RickAndMortyApiClient;
use App\Repository\Cache\Redis\RickAndMorty\RickAndMortyCacheRepository;
use App\Service\Url\Generator\RickAndMorty\RickAndMortyUrlGeneratorService;
use App\Service\Url\UrlService;
use PHPUnit\Framework\TestCase;
use App\Exception\InvalidUrlException;

class RickAndMortyUrlGeneratorServiceTest extends TestCase
{
    private RickAndMortyApiClient $httpClient;
    private UrlService $urlService;
    private RickAndMortyCacheRepository $cacheRepository;
    private RickAndMortyUrlGeneratorService $generatorService;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(RickAndMortyApiClient::class);
        $this->urlService = $this->createMock(UrlService::class);
        $this->cacheRepository = $this->createMock(RickAndMortyCacheRepository::class);
        $this->generatorService = new RickAndMortyUrlGeneratorService(
            $this->httpClient,
            $this->urlService,
            $this->cacheRepository
        );

        parent::setUp();
    }

    public function testUrlGeneratorGeneratesUrl()
    {
        $this->httpClient
            ->expects($this->once())
            ->method('fetchCharacters')
            ->willReturn($this->characterListDTO());

        $results = $this->generatorService->generateUrls();

        $expectedUrls = [
            'https://rickandmortyapi.com/api/character/avatar/1.jpeg'
        ];

        $this->assertEquals($expectedUrls, $results);
    }

    public function testUrlGeneratorThrowsInvalidUrlException()
    {
        $this->httpClient
            ->expects($this->once())
            ->method('fetchCharacters')
            ->willReturn($this->characterListDTOWithInvalidUrls());

        $this->expectException(InvalidUrlException::class);

        $this->generatorService->generateUrls();
    }

    private function characterListDTO(): CharacterListDTO
    {
        return new CharacterListDTO(
            [
                new CharacterDTO(
                    1,
                    'Rick Sanchez',
                    'Human',
                    'Citadel of Ricks',
                    'https://rickandmortyapi.com/api/character/avatar/1.jpeg'
                )
            ],
            new MetadataDTO(
                826,
                42,
                'https://rickandmortyapi.com/api/character?page=2',
                null
            )
        );
    }

    private function characterListDTOWithInvalidUrls(): CharacterListDTO
    {
        return new CharacterListDTO(
            [
                new CharacterDTO(
                    1,
                    'Rick Sanchez',
                    'Human',
                    'Citadel of Ricks',
                    'rickandmortyapi.com/api/character/avatar/1.jpeg'
                )
            ],
            new MetadataDTO(
                826,
                42,
                'https://rickandmortyapi.com/api/character?page=2',
                null
            )
        );
    }
}
