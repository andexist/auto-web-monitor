<?php

declare(strict_types=1);

namespace App\DTO\RickAndMarty\Character;

use App\DTO\RickAndMarty\MetadataDTO;

class CharacterListDTO
{
    public function __construct(
        private array $characterDTO,
        private MetadataDTO $metadataDTO
    ) {
    }

    /**
     * @return CharacterDTO[]
     */
    public function getCharacterDTO(): array
    {
        return $this->characterDTO;
    }

    public function setCharacterDTO(array $characterDTO)
    {
        $this->characterDTO = $characterDTO;
    }

    public function getMetadataDTO(): MetadataDTO
    {
        return $this->metadataDTO;
    }

    public function setMetadataDTO(MetadataDTO $metadataDTO)
    {
        $this->metadataDTO = $metadataDTO;
    }
}
