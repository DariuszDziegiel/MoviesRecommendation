<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;

class MultiWordMoviesRecommendationStrategy implements RecommendationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function recommendMovies(array $movies): array
    {
        return [
            new Movie('multiword1'),
            new Movie('multiword2'),
            new Movie('multiword3'),
        ];
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 3;
    }


}
