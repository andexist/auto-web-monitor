<?php

declare(strict_types=1);

namespace App\Repository\Cache\Redis\RickAndMorty;

use App\CacheClient\Redis\Interface\RedisClientInterface;
use App\Repository\Cache\Redis\AbstractRedisRepository;
use App\Repository\Cache\Redis\RickAndMorty\Interface\RickAndMortyCacheRepositoryInterface;

class RickAndMortyCacheRepository extends AbstractRedisRepository implements RickAndMortyCacheRepositoryInterface
{
    protected string $cacheKey = 'rick_and_morty_%d';

    public function __construct(protected RedisClientInterface $redis)
    {
        parent::__construct($redis);
    }

    protected function key(int $uniqid): string
    {
        return sprintf($this->cacheKey, $uniqid);
    }
}
