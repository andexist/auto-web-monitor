<?php

declare(strict_types=1);

namespace App\Exception\RickAndMorty;

class RickAndMortyNoNextPageException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("No next page available in Rick and Morty API");
    }
}
