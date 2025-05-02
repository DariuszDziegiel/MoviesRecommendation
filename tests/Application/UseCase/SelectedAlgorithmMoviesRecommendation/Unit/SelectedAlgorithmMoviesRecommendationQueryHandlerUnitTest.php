<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase\SelectedAlgorithmMoviesRecommendation\Unit;

use App\Application\DTO\MovieRecommendationDTO;
use App\Application\Recommendation\Factory\RecommendationStrategyFactoryInterface;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQuery;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQueryHandler;
use App\Domain\Movie\Movie;
use App\Domain\Movie\MovieRepositoryInterface;
use App\Domain\Recommendation\Strategy\RecommendationStrategyInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SelectedAlgorithmMoviesRecommendationQueryHandlerUnitTest extends TestCase
{

    #[Test]
    public function handler_returns_dtos_for_given_query_with_algorithm_id(): void
    {
        $query = new SelectedAlgorithmMoviesRecommendationQuery(recommendationAlgorithmId: 1);

        $movies = [
            new Movie('Matrix'),
            new Movie('Incepcja'),
            new Movie('Nietykalni'),
            new Movie('Django'),
            new Movie('Szósty zmysł'),
        ];

        $movieRepository = $this->createMock(MovieRepositoryInterface::class);
        $movieRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($movies);

        $strategy = $this->createMock(RecommendationStrategyInterface::class);
        $strategy
            ->expects($this->once())
            ->method('recommendMovies')
            ->with($movies)
            ->willReturn([
                $movies[0],
                $movies[1],
                $movies[2]
            ]);

        $strategyFactory = $this->createMock(RecommendationStrategyFactoryInterface::class);
        $strategyFactory
            ->expects($this->once())
            ->method('create')
            ->with(1)
            ->willReturn($strategy);

        $handler = new SelectedAlgorithmMoviesRecommendationQueryHandler(
            $movieRepository,
            $strategyFactory
        );

        $recommendedMovies = $handler($query);

        $this->assertIsArray($recommendedMovies);
        $this->assertContainsOnlyInstancesOf(MovieRecommendationDTO::class, $recommendedMovies);
        $this->assertCount(3, $recommendedMovies);
        $this->assertSame("Matrix", $recommendedMovies[0]->title);
        $this->assertSame("Incepcja", $recommendedMovies[1]->title);
        $this->assertSame("Nietykalni", $recommendedMovies[2]->title);
    }
}
