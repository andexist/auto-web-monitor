<?php

namespace App\Repository\Url;

use App\Entity\Url;
use App\Repository\Ulr\Interface\UrlRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Url>
 *
 * @method Url|null find($id, $lockMode = null, $lockVersion = null)
 * @method Url|null findOneBy(array $criteria, array $orderBy = null)
 * @method Url[]    findAll()
 * @method Url[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UrlRepository extends ServiceEntityRepository implements UrlRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Url::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Url
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?Url
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function count(array $criteria = []): int
    {
        return parent::count($criteria);
    }

    public function persist(Url $url): void
    {
        $em = $this->getEntityManager();
        $em->persist($url);
        $em->flush();
    }

    public function delete(Url $url): void
    {
        $em = $this->getEntityManager();
        $em->remove($url);
        $em->flush();
    }
}
