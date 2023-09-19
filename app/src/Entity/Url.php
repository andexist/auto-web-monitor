<?php

namespace App\Entity;

use App\Repository\UrlRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UrlRepository::class)]
class Url
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(nullable: true)]
    private ?int $statusCode = null;

    #[ORM\Column(nullable: true)]
    private ?int $request_count = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $possible_keywords = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function setStatusCode(?int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getRequestCount(): ?int
    {
        return $this->request_count;
    }

    public function setRequestCount(?int $request_count): static
    {
        $this->request_count = $request_count;

        return $this;
    }

    public function getPossibleKeywords(): ?string
    {
        return $this->possible_keywords;
    }

    public function setPossibleKeywords(?string $possible_keywords): static
    {
        $this->possible_keywords = $possible_keywords;

        return $this;
    }
}
