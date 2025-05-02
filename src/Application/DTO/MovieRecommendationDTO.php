<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Movie\Movie;

class MovieRecommendationDTO
{
    public function __construct(
        public string $title
    ) {}

    public static function createFromMovie(Movie $movie): self
    {
        return new self($movie->title());
    }
}
