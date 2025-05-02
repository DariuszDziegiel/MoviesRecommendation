<?php

declare(strict_types=1);

namespace App\Tests\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;
use App\Domain\Recommendation\Strategy\MultiWordTitleMoviesRecommendationStrategy;
use App\Tests\Infrastructure\Persistence\InMemoryMovieRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MultiWordMoviesRecommendationStrategyTest extends TestCase
{
    #[Test]
    public function strategy_recommends_only_multi_word_title_movies(): void
    {
        $inMemoryMovieRepository = new InMemoryMovieRepository();
        $strategy = new MultiWordTitleMoviesRecommendationStrategy();

        $recommendedMovies = $strategy->recommendMovies($inMemoryMovieRepository->findAll());

        $this->assertContainsOnlyInstancesOf(Movie::class, $recommendedMovies);
        foreach ($recommendedMovies as $movie) {
            $this->assertTrue(
                $movie->hasMultiWordTitle(),
                $movie->title()
            );
        }
    }
}
