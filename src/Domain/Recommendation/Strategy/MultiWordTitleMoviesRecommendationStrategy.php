<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;

class MultiWordTitleMoviesRecommendationStrategy implements RecommendationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function recommendMovies(array $movies): array
    {
        return array_values(
            array_filter(
                $movies,
                fn(Movie $movie) => $movie->hasMultiWordTitle()
            )
        );
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 3;
    }
}
