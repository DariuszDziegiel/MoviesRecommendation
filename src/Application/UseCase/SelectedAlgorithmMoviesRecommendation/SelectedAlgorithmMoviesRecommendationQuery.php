<?php

declare(strict_types=1);

namespace App\Application\UseCase\SelectedAlgorithmMoviesRecommendation;

class SelectedAlgorithmMoviesRecommendationQuery
{
    public function __construct(
        public int $recommendationAlgorithmId
    ) {}
}
