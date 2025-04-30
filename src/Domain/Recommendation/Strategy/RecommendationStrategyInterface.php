<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;

interface RecommendationStrategyInterface
{
    /**
     * @param Movie[] $movies
     * @return Movie[]
     */
    public function recommendMovies(array $movies): array;

    public function supports(int $strategyId): bool;
}
