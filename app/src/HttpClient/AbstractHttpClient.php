<?php

declare(strict_types=1);

namespace App\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractHttpClient
{
     public function __construct(
          private HttpClientInterface $client,
          private string $uri,
          private array $headers
     ) {
     }

     protected function fetch(string $method, string $path, array $queryParams): array
     {
          $uri = $this->uri . '/' . $path;
          $options = [
               'query' => $queryParams,
               'headers' => $this->headers,
          ];

          $response = $this->client->request($method, $uri, $options);

          return $response->toArray();
     }
}
