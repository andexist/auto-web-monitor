<?php

declare(strict_types=1);

namespace App\DTO\Url;

class UrlDataDTO
{
    public function __construct(
        private int $statusCode,
        private int $redirectsCount,
        private ?string $possibleKeywords
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function getRedirectsCount(): int
    {
        return $this->redirectsCount;
    }

    public function setRedirectsCount(int $redirectsCount)
    {
        $this->redirectsCount = $redirectsCount;
    }

    public function getPossibleKeywords(): ?string
    {
        return $this->possibleKeywords;
    }

    public function setPossibleKeywords(string $possibleKeywords)
    {
        $this->possibleKeywords = $possibleKeywords;
    }
}
