<?php

declare(strict_types=1);

namespace App\CacheClient\Redis;

use App\CacheClient\Redis\Interface\RedisClientInterface;
use Predis\Client;

class RedisClient implements RedisClientInterface
{
    private Client $client;

    public function __construct(string $host, int $port)
    {
        $this->client = new Client(["host" => $host, "port" => $port]);
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
