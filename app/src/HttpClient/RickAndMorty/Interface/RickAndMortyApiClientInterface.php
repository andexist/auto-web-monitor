<?php

declare(strict_types=1);

namespace App\HttpClient\RickAndMorty\Interface;

use App\DTO\RickAndMarty\Character\CharacterListDTO;

interface RickAndMortyApiClientInterface
{
    public function fetchCharacters(int $page): CharacterListDTO;
}
