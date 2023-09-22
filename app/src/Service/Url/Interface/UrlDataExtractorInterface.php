<?php

declare(strict_types=1);

namespace App\Service\Url\Interface;

use App\DTO\Url\UrlDataDTO;
use Symfony\Component\HttpClient\Response\CurlResponse;

interface UrlDataExtractorInterface
{
    public function extractUrlData(string $url): UrlDataDTO;
    public function getUrlStatusCode(CurlResponse $response): int;
    public function getUrlRedirectsCount(CurlResponse $response): int;
    public function getUrlPossibleKeywords(string $url): string;
}
