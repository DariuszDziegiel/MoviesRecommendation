<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;

class RandomRecommendationStrategy implements RecommendationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function recommendMovies(array $movies): array
    {
        return [
            new Movie('losowy1'),
            new Movie('losowy2'),
            new Movie('losowy3'),
        ];
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 1;
    }
}
