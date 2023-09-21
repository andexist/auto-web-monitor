<?php

declare(strict_types=1);

namespace App\Repository\Cache\Redis;

use App\CacheClient\Redis\Interface\RedisClientInterface;

abstract class AbstractRedisRepository
{
    protected string $previousKeyKey = 'previous_key';

    public function __construct(protected RedisClientInterface $redis)
    {
    }

    abstract protected function key(int $uniqid): string;

    public function getPreviousKey(): ?string
    {
        $previousKey = $this->redis->getClient()->get($this->previousKeyKey);

        return $previousKey;
    }

    public function setPreviousKey(string $data)
    {
        $this->redis->getClient()->set($this->previousKeyKey, $data);
    }


    public function set(int $uniqid, string $data)
    {
        $this->redis->getClient()->set(
            $this->key($uniqid),
            $data
        );
    }

    public function get(int $uniqId): string
    {
        return $this->redis->getClient()->get(
            $this->key($uniqId)
        );
    }

    public function delete(int $uniqid)
    {
        $this->redis->getClient()->del(
            $this->key($uniqid)
        );
    }
}
