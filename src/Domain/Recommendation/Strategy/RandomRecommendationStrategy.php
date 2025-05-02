<?php

declare(strict_types=1);

namespace App\Domain\Recommendation\Strategy;

class RandomRecommendationStrategy implements RecommendationStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function recommendMovies(array $movies): array
    {
        if (count($movies) < 3) {
            return $movies;
        }

        $randomKeys = array_rand($movies, 3);

        return array_map(
            fn($key) => $movies[$key],
            $randomKeys
        );
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 1;
    }
}
