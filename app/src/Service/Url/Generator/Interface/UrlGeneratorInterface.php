<?php

declare(strict_types=1);

namespace App\Service\Url\Generator\Interface;

interface UrlGeneratorInterface
{
    public function generateUrl(): string;
    public function generateUrls(): array;
}
