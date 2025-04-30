<?php

declare(strict_types=1);

namespace App\Domain\Movie;

interface MovieRepositoryInterface
{
    /** @return Movie[]*/
    public function findAll(): array;
}
