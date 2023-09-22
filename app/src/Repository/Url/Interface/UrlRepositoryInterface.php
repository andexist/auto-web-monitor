<?php

declare(strict_types=1);

namespace App\Repository\Url\Interface;

use App\Entity\Url;

interface UrlRepositoryInterface
{
    public function find($id, $lockMode = null, $lockVersion = null): ?Url;
    public function findAll(): array;
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array;
    public function findOneBy(array $criteria, array $orderBy = null): ?Url;
    public function findUrlsWithEmptyFields(): array;
    public function count(array $criteria = []): int;
    public function persist(Url $url): void;
    public function delete(Url $url): void;
}
