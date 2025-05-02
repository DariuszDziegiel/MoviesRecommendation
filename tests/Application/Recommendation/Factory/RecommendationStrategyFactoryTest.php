<?php

declare(strict_types=1);

namespace App\Tests\Application\Recommendation\Factory;

use App\Application\Exception\AlgorithmWithGivenIdNotExistsException;
use App\Application\Recommendation\Factory\RecommendationStrategyFactory;
use App\Domain\Recommendation\Strategy\MultiWordTitleMoviesRecommendationStrategy;
use App\Domain\Recommendation\Strategy\RandomRecommendationStrategy;
use App\Domain\Recommendation\Strategy\TitleStartWithWAndHasEvenLengthRecommendationStrategy;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RecommendationStrategyFactoryTest extends TestCase
{
    #[Test]
    public function factory_returns_correct_recommendation_strategy_for_given_algorithm_id(): void
    {
        $recommendationStrategyFactory = new RecommendationStrategyFactory(
            [
                new RandomRecommendationStrategy(),
                new TitleStartWithWAndHasEvenLengthRecommendationStrategy(),
                new MultiWordTitleMoviesRecommendationStrategy(),
            ]
        );

        $this->assertInstanceOf(
            RandomRecommendationStrategy::class,
            $recommendationStrategyFactory->create(1)
        );

        $this->assertInstanceOf(
            TitleStartWithWAndHasEvenLengthRecommendationStrategy::class,
            $recommendationStrategyFactory->create(2)
        );

        $this->assertInstanceOf(
            MultiWordTitleMoviesRecommendationStrategy::class,
            $recommendationStrategyFactory->create(3)
        );
    }

    #[Test]
    public function factory_throw_exception_for_not_existing_algorithm_id(): void
    {
        $recommendationStrategyFactory = new RecommendationStrategyFactory(
            [
                new RandomRecommendationStrategy(),
                new TitleStartWithWAndHasEvenLengthRecommendationStrategy(),
                new MultiWordTitleMoviesRecommendationStrategy(),
            ]
        );

        $this->expectException(AlgorithmWithGivenIdNotExistsException::class);

        $recommendationStrategyFactory->create(123456789);
    }
}
