<?php

declare(strict_types=1);

namespace App\HttpClient;

use Symfony\Component\HttpClient\Response\CurlResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractHttpClient
{
     public function __construct(
          protected HttpClientInterface $client,
          protected string $uri,
          protected array $headers
     ) {
     }

     protected function fetch(string $method, string $path, array $queryParams): CurlResponse
     {
          $uri = $this->uri . '/' . $path;
          $options = [
               'query' => $queryParams,
               'headers' => $this->headers,
          ];

          $response = $this->client->request($method, $uri, $options);

          return $response;
     }
}
