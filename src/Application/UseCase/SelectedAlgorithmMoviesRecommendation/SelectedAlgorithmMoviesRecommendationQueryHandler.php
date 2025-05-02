<?php

declare(strict_types=1);

namespace App\Application\UseCase\SelectedAlgorithmMoviesRecommendation;

use App\Application\DTO\MovieRecommendationDTO;
use App\Application\Recommendation\Factory\RecommendationStrategyFactoryInterface;
use App\Domain\Movie\Movie;
use App\Domain\Movie\MovieRepositoryInterface;

readonly class SelectedAlgorithmMoviesRecommendationQueryHandler
{
    public function __construct(
        private MovieRepositoryInterface $movieRepository,
        private RecommendationStrategyFactoryInterface $recommendationStrategyFactory
    ) {}

    /**
     * @return MovieRecommendationDTO[]
     */
    public function __invoke(SelectedAlgorithmMoviesRecommendationQuery $getMoviesRecommendationQuery): array
    {
        $algorithmId = $getMoviesRecommendationQuery->recommendationAlgorithmId;

        $recommendationStrategy = $this->recommendationStrategyFactory->create($algorithmId);

        $recommendedMovies = $recommendationStrategy->recommendMovies(
            $this->movieRepository->findAll()
        );

        return array_map(
            fn(Movie $movie) => MovieRecommendationDTO::createFromMovie($movie),
            $recommendedMovies
        );
    }
}
