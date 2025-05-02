<?php

declare(strict_types=1);

namespace App\Tests\Domain\Movie;

use App\Domain\Movie\Movie;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    #[Test]
    #[DataProvider('multiWordTitleMoviesProvider')]
    public function movie_has_multiword_title(Movie $movie): void
    {
        $this->assertTrue($movie->hasMultiWordTitle());
    }

    #[Test]
    #[DataProvider('oneWordTitleMoviesProvider')]
    public function movie_has_not_multiword_title(Movie $movie): void
    {
        $this->assertFalse($movie->hasMultiWordTitle());
    }

    #[Test]
    public function title_starts_with_w_and_has_even_length(): void
    {
        $movies = [
            new Movie("Whiplash"),
            new Movie("Wyspa tajemnic"),
            new Movie("Władca Pierścieni: Drużyna Pierścienia")
        ];

        foreach ($movies as $movie) {
            $this->assertTrue($movie->hasTitleStartsWithWLetterAndHaveEvenLength(), $movie->title());
        }
    }

    #[Test]
    public function movie_object_construction(): void
    {
        $title = "Matrix";
        $movie = new Movie($title);

        $this->assertSame($title, $movie->title());
    }

    #[Test]
    public function title_not_starts_with_w_letter_and_have_even_length(): void
    {
        $movies = [
            new Movie("Matrix"),
            new Movie("Whiplash9"),
            new Movie("Wyspa tajemnic9"),
        ];

        foreach ($movies as $movie) {
            $this->assertFalse($movie->hasTitleStartsWithWLetterAndHaveEvenLength(), $movie->title());
        }
    }

    public static function multiWordTitleMoviesProvider(): array
    {
        return [
            'Skazani na Shawshank' => [new Movie("Skazani na Shawshank")],
            'Ojciec chrzestny'     => [new Movie("Ojciec chrzestny")],
            'Leon zawodowiec'      => [new Movie("Leon zawodowiec")],
            'Dwunastu gniewnych ludzi'        => [new Movie("Dwunastu gniewnych ludzi")],
            'Władca Pierścieni: Powrót króla' => [new Movie("Władca Pierścieni: Powrót króla")]
        ];
    }

    public static function oneWordTitleMoviesProvider(): array
    {
        return [
            'Siedem'    => [new Movie("Siedem")],
            'Gladiator' => [new Movie("Gladiator")],
            'Django'    => [new Movie("Django")],
            'Labirynt'  => [new Movie("Labirynt")],
            'Shrek'     => [new Movie("Shrek")]
        ];
    }

}
