<?php

declare(strict_types=1);

namespace App\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractHttpClient
{
   public function __construct(private HttpClientInterface $httpClient)
   {
        // Constructor code here
   }

    abstract public function get();
}
