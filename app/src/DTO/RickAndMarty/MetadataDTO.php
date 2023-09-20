<?php

declare(strict_types=1);

namespace App\DTO\RickAndMarty;

class MetadataDTO
{
    public function __construct(
        private int $count,
        private int $pages,
        private ?string $next,
        private ?string $prev
    ) {
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count)
    {
        $this->count = $count;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function setPages(int $pages)
    {
        $this->pages = $pages;
    }

    public function getNext(): ?string
    {
        return $this->next;
    }

    public function setNext(?string $next)
    {
        $this->next = $next;
    }

    public function getPrev(): ?string
    {
        return $this->prev;
    }

    public function setPrev(?string $prev)
    {
        $this->prev = $prev;
    }
}
