<?php

declare(strict_types=1);

namespace App\Service\Url;

use App\Exception\MissingResourceException;
use App\Repository\Url\Interface\UrlRepositoryInterface;
use App\Entity\Url;

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

      throw new MissingResourceException((string)$id, Url::class);
   }

   /**
    * @return Url[]
    */
   public function findUrlsWithEmptyFields(): array
   {
      return $this->urlRepository->findUrlsWithEmptyFields();
   }

   public function findAll(): array
   {
      return $this->urlRepository->findAll();
   }

   public function persist(Url $url)
   {
      $this->urlRepository->persist($url);
   }
}
