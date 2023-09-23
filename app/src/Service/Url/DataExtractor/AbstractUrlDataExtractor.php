<?php

declare(strict_types=1);

namespace App\Service\Url\DataExtractor;

use App\DTO\Url\UrlDataDTO;
use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Constants\HttpMethodConstants;

abstract class AbstractUrlDataExtractor
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    abstract protected function getUrlPossibleKeywords(string $url): string;

    public function extractUrlData(string $url): UrlDataDTO
    {
        $response = $this->httpClient->request(HttpMethodConstants::GET, $url);

        return new UrlDataDTO(
            $this->getUrlStatusCode($response),
            $this->getUrlRedirectsCount($response),
            $this->getUrlPossibleKeywords($url)
        );
    }

    public function getUrlStatusCode(CurlResponse $response): int
    {
        return $response->getStatusCode();
    }

    public function getUrlRedirectsCount(CurlResponse $response): int
    {
        return $response->getInfo('redirect_count');
    }
}
