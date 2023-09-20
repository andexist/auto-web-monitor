<?php

declare(strict_types=1);

namespace App\Service\Url;

use App\Repository\Url\Interface\UrlRepositoryInterface;
use App\Entity\Url;
use Exception;

class UrlService
{
   public function __construct(private UrlRepositoryInterface $urlRepository)
   {
   }

   public function find(int $id): Url
   {
      if ($url = $this->urlRepository->find($id)) {
         return $url;
      }

      throw new Exception("change this exception into ResourceNotFoundException");
   }

   public function findALl(): array
   {
      return $this->urlRepository->findAll();
   }

   public function persist(Url $url)
   {
      $this->urlRepository->persist($url);
   }
}
