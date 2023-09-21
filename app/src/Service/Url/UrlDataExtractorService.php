<?php

declare(strict_types=1);

namespace App\Service\Url;

use App\DTO\Url\UrlDataDTO;
use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UrlDataExtractorService
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function extractUrlData(string $url): UrlDataDTO
    {
        $resposne = $this->httpClient->request('GET', $url);

        return new UrlDataDTO(
            $this->getUrlStatusCode($resposne),
            $this->getUrlRedirectsCount($resposne),
            $this->getUrlPossibleKeywords($url)
        );
    }

    private function getUrlStatusCode(CurlResponse $response): int
    {
        return $response->getStatusCode();
    }

    private function getUrlRedirectsCount(CurlResponse $response): int
    {
        return $response->getInfo('redirect_count');
    }

    private function getUrlPossibleKeywords(string $url): string
    {
        $keywords = null;

        if (stripos($url, 'api')) {
            $apiPos = strpos($url, "/api/");
            $url = substr($url, $apiPos + strlen("/api/"));
            $url = explode('/', $url);
            $keywords = json_encode($url);
        }

        return $keywords;
    }
}
