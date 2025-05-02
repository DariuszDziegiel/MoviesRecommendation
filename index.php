<?php
declare(strict_types=1);

namespace App;

require __DIR__ . '/vendor/autoload.php';

use App\Application\DTO\MovieRecommendationDTO;
use App\Application\Exception\ApplicationException;
use App\Application\Recommendation\Factory\RecommendationStrategyFactory;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQuery;
use App\Application\UseCase\SelectedAlgorithmMoviesRecommendation\SelectedAlgorithmMoviesRecommendationQueryHandler;
use App\Domain\Recommendation\Strategy\MultiWordTitleMoviesRecommendationStrategy;
use App\Domain\Recommendation\Strategy\RandomRecommendationStrategy;
use App\Domain\Recommendation\Strategy\TitleStartWithWAndHasEvenLengthRecommendationStrategy;
use App\Infrastructure\Persistence\FileMovieRepository;

/**
 * Id algorytmów:
 * 1: Zwracane są 3 losowe tytuły.
 * 2: Zwracane są wszystkie filmy na literę ‘W’ ale tylko jeśli mają parzystą liczbę znaków w tytule.
 * 3: Zwracany są wszystkie tytuły, które składają się z więcej niż 1 słowa.
 */

$algorithmId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

try {
    $selectedAlgorithmMoviesRecommendationQueryHandler = new SelectedAlgorithmMoviesRecommendationQueryHandler(
        new FileMovieRepository(),
        new RecommendationStrategyFactory(
            [
                new RandomRecommendationStrategy(),
                new TitleStartWithWAndHasEvenLengthRecommendationStrategy(),
                new MultiWordTitleMoviesRecommendationStrategy(),
            ]
        )
    );

    $recommendedMovies = $selectedAlgorithmMoviesRecommendationQueryHandler(
        new SelectedAlgorithmMoviesRecommendationQuery($algorithmId)
    );

    echo json_encode(
        array_map(
            fn(MovieRecommendationDTO $movieRecommendationDTO) => $movieRecommendationDTO->title,
            $recommendedMovies
        ),
        JSON_UNESCAPED_UNICODE
    );

} catch (ApplicationException $e) {
    echo $e->getMessage();
} catch (\Throwable $e) {
    echo 'Unexpected error - try again later';
}
