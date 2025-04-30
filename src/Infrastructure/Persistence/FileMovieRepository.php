<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Movie\Movie;
use App\Domain\Movie\MovieRepositoryInterface;

class FileMovieRepository implements MovieRepositoryInterface
{
    /** @return Movie[] */
    public function findAll(): array
    {
        $moviesFromFile = require __DIR__ . '/../../../data/movies.php';

        return array_map(
            fn($title) => new Movie($title),
            $moviesFromFile
        );
    }
}
