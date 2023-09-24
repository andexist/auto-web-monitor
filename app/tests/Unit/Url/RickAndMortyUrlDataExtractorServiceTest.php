<?php

declare(strict_types=1);

namespace App\Tests\Unit\Url;

use App\Service\Url\DataExtractor\RickAndMorty\RickAndMortyUrlDataExtractorService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RickAndMortyUrlDataExtractorServiceTest extends TestCase
{
    public function testGetUrlPossibleKeywords()
    {
        $httpClient = $this->createMock(HttpClientInterface::class);

        $extractorService = new RickAndMortyUrlDataExtractorService($httpClient);

        $url = 'https://rickandmortyapi.com/api/character/1';
        $expectedKeywords = '["character","1"]';

        $reflectionClass = new \ReflectionClass($extractorService);
        $method = $reflectionClass->getMethod('getUrlPossibleKeywords');
        $method->setAccessible(true);

        $actualKeywords = $method->invoke($extractorService, $url);

        $this->assertEquals($expectedKeywords, $actualKeywords);
    }
}
