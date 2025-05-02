<?php

declare(strict_types=1);

namespace App\Tests\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;
use App\Domain\Recommendation\Strategy\RandomRecommendationStrategy;
use App\Tests\Infrastructure\Persistence\InMemoryMovieRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RandomRecommendationStrategyTest extends TestCase
{
    #[Test]
    public function strategy_recommends_three_random_movies(): void
    {
        $inMemoryMovieRepository = new InMemoryMovieRepository();
        $strategy = new RandomRecommendationStrategy();

        $movies = $strategy->recommendMovies($inMemoryMovieRepository->findAll());

        $this->assertEquals(3, count($movies));
        $this->assertContainsOnlyInstancesOf(Movie::class, $movies);
    }

    #[Test]
    public function strategy_returns_empty_array_when_there_are_no_movies_to_recommend(): void
    {
        $strategy = new RandomRecommendationStrategy();

        $movies = $strategy->recommendMovies([]);

        $this->assertEmpty($movies);
    }

    #[Test]
    public function strategy_recommends_passed_as_argument_movies_when_there_are_less_than_three_movies_to_recommend(): void
    {
        $strategy = new RandomRecommendationStrategy();
        $movies = [
            new Movie('Nietykalni'),
            new Movie('Siedem'),
        ];

        $moviesRecommendation = $strategy->recommendMovies($movies);

        $this->assertSame($movies, $moviesRecommendation);
    }

}
