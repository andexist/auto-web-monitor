<?php

declare(strict_types=1);

namespace App\Service\Url\Generator;

abstract class AbstractUrlGenerator
{
    abstract protected function generateUrl(): void;
}
