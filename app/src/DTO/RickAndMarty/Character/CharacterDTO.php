<?php

declare(strict_types=1);

namespace App\DTO\RickAndMarty\Character;

class CharacterDTO
{
    public function __construct(
        private int $id,
        private string $name,
        private string $species,
        private string $locationName,
        private string $image
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function setSpecies(string $species)
    {
        $this->species = $species;
    }

    public function getLocationName(): string
    {
        return $this->locationName;
    }

    public function setLocationName(string $locationName)
    {
        $this->locationName = $locationName;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }
}
