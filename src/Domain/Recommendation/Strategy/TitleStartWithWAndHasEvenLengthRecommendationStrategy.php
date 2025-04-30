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
        return [
            new Movie('w-start1'),
            new Movie('w-start2'),
            new Movie('w-start3'),
        ];
    }

    public function supports(int $strategyId): bool
    {
        return $strategyId == 2;
    }
}
