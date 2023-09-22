<?php

declare(strict_types=1);

namespace App\Serializer\Url;

use App\Entity\Url;
use Symfony\Component\Serializer\SerializerInterface;

class UrlSerializer
{
   public function __construct(private SerializerInterface $serializer)
   {
   }

   /**
    * @param Url[] $urls
    */
   public function serializeArray(array $urls)
   {
      return $this->serializer->serialize($urls, 'json');
   }

   public function serialize(Url $urls)
   {
      return $this->serializer->serialize($urls, 'json');
   }
}
