<?php

declare(strict_types=1);

namespace App\Exception;

class InvalidUrlException extends \Exception
{
    public function __construct(string $class, array $invalidUrls)
    {
        $message = sprintf("Invalid URL's encountered in '%s'. URLs: %s", $class, implode(', ', $invalidUrls));
        parent::__construct($message);
    }
}
