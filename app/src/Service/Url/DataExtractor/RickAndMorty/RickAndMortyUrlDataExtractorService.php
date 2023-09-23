<?php

declare(strict_types=1);

namespace App\Service\Url\DataExtractor\RickAndMorty;

use App\Service\Url\DataExtractor\AbstractUrlDataExtractor;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RickAndMortyUrlDataExtractorService extends AbstractUrlDataExtractor
{
    public function __construct(protected HttpClientInterface $httpClient)
    {
        parent::__construct($httpClient);
    }

    protected function getUrlPossibleKeywords(string $url): string
    {
        $keywords = '';

        if (stripos($url, 'api')) {
            $apiPos = strpos($url, "/api/");
            $url = substr($url, $apiPos + strlen("/api/"));
            $url = explode('/', $url);
            $keywords = json_encode($url);
        }

        return $keywords;
    }
}
