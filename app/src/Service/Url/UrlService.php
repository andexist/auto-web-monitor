<?php

declare(strict_types=1);

namespace App\Service\Url;

use App\Repository\Ulr\Interface\UrlRepositoryInterface;

class UrlService
{
   public function __construct(private UrlRepositoryInterface $urlRepository)
   {}

   public function myMethod()
   {
        // Method code here
   }
}
