<?php

declare(strict_types=1);

namespace App\Tests\Domain\Recommendation\Strategy;

use App\Domain\Movie\Movie;
use App\Domain\Recommendation\Strategy\TitleStartWithWAndHasEvenLengthRecommendationStrategy;
use App\Tests\Infrastructure\Persistence\InMemoryMovieRepository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TitleStartWithWAndHasEvenLengthRecommendationStrategyTest extends TestCase
{
    #[Test]
    public function strategy_recommends_only_movies_with_title_starting_with_W_and_having_even_length(): void
    {
        $inMemoryMovieRepository = new InMemoryMovieRepository();
        $strategy = new TitleStartWithWAndHasEvenLengthRecommendationStrategy();

        $recommendedMovies = $strategy->recommendMovies($inMemoryMovieRepository->findAll());

        $this->assertContainsOnlyInstancesOf(Movie::class, $recommendedMovies);
        foreach ($recommendedMovies as $movie) {
            $this->assertTrue(
                $movie->hasTitleStartsWithWLetterAndHaveEvenLength(),
                $movie->title()
            );
        }
    }
}
