<?php

declare(strict_types=1);

namespace App\CacheClient\Redis\Interface;

use Predis\Client;

interface RedisClientInterface
{
    public function getClient(): Client;
}
