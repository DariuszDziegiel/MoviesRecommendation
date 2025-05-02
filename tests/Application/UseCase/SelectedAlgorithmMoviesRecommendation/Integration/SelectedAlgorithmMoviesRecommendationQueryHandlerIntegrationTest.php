<?php

declare(strict_types=1);

namespace App\Tests\Application\UseCase\SelectedAlgorithmMoviesRecommendation\Integration;

use App\Application\DTO\MovieRecommendationDTO;
use App\Application\Exception\AlgorithmWithGivenIdNotExistsException;
use App\Application\Recommendation\Factory\RecommendationStrategyFactory;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQuery;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQueryHandler;
use App\Domain\Recommendation\Strategy\MultiWordTitleMoviesRecommendationStrategy;
use App\Domain\Recommendation\Strategy\RandomRecommendationStrategy;
use App\Domain\Recommendation\Strategy\TitleStartWithWAndHasEvenLengthRecommendationStrategy;
use App\Tests\Infrastructure\Persistence\InMemoryMovieRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SelectedAlgorithmMoviesRecommendationQueryHandlerIntegrationTest extends TestCase
{
    private SelectedAlgorithmMoviesRecommendationQueryHandler $selectedAlgorithmMoviesRecommendationQueryHandler;

    public function setUp(): void
    {
        $this->selectedAlgorithmMoviesRecommendationQueryHandler = new SelectedAlgorithmMoviesRecommendationQueryHandler(
            new InMemoryMovieRepository(),
            new RecommendationStrategyFactory(
                [
                    new RandomRecommendationStrategy(),
                    new TitleStartWithWAndHasEvenLengthRecommendationStrategy(),
                    new MultiWordTitleMoviesRecommendationStrategy(),
                ]
            )
        );
    }

    #[Test]
    public function three_movies_for_algorithm_1_are_recommended(): void
    {
        $recommendedMovies = ($this->selectedAlgorithmMoviesRecommendationQueryHandler)(
            new SelectedAlgorithmMoviesRecommendationQuery(1)
        );

        $this->assertContainsOnlyInstancesOf(MovieRecommendationDTO::class, $recommendedMovies);
        $this->assertEquals(3, count($recommendedMovies));
    }

    #[Test]
    public function all_recommended_movies_for_algorithm_2_start_with_W_and_have_even_length(): void
    {
        $recommendedMovies = ($this->selectedAlgorithmMoviesRecommendationQueryHandler)(
            new SelectedAlgorithmMoviesRecommendationQuery(2)
        );

        $this->assertContainsOnlyInstancesOf(MovieRecommendationDTO::class, $recommendedMovies);
        foreach ($recommendedMovies as $recommendedMovieDTO) {
            $this->assertTrue(
                str_starts_with($recommendedMovieDTO->title, 'W')
                && mb_strlen($recommendedMovieDTO->title) % 2 === 0
            );
        }
    }

    #[Test]
    public function all_recommended_movies_for_algorithm_3_have_multi_word_titles(): void
    {
        $recommendedMovies = ($this->selectedAlgorithmMoviesRecommendationQueryHandler)(
            new SelectedAlgorithmMoviesRecommendationQuery(3)
        );

        $this->assertContainsOnlyInstancesOf(MovieRecommendationDTO::class, $recommendedMovies);
        foreach ($recommendedMovies as $recommendedMovieDTO) {
            $this->assertTrue(str_word_count($recommendedMovieDTO->title) > 1);
        }
    }

    #[Test]
    public function handler_throw_exception_for_not_existed_algorithm(): void
    {
        $this->expectException(AlgorithmWithGivenIdNotExistsException::class);

        ($this->selectedAlgorithmMoviesRecommendationQueryHandler)(
            new SelectedAlgorithmMoviesRecommendationQuery(123456)
        );
    }
}
