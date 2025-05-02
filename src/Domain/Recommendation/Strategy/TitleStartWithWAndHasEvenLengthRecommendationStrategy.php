<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;

class TitleStartWithWAndHasEvenLengthRecommendationStrategy implements RecommendationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function recommendMovies(array $movies): array
    {
        return array_values(
            array_filter(
                $movies,
                fn(Movie $movie) => $movie->hasTitleStartsWithWLetterAndHaveEvenLength()
            )
        );
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 2;
    }
}
