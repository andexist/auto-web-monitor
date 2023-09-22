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
    private ?int $redirectsCount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $possibleKeywords = null;

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

    public function getRedirectsCount(): ?int
    {
        return $this->redirectsCount;
    }

    public function setRedirectsCount(?int $redirectsCount): static
    {
        $this->redirectsCount = $redirectsCount;

        return $this;
    }

    public function getPossibleKeywords(): ?string
    {
        return $this->possibleKeywords;
    }

    public function setPossibleKeywords(?string $possibleKeywords): static
    {
        $this->possibleKeywords = $possibleKeywords;

        return $this;
    }
}
