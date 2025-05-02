<?php

declare(strict_types=1);

namespace App\Application\Recommendation\Factory;

use App\Application\Exception\AlgorithmWithGivenIdNotExistsException;
use App\Domain\Recommendation\Strategy\RecommendationStrategyInterface;

readonly class RecommendationStrategyFactory implements RecommendationStrategyFactoryInterface
{
    public function __construct(
        /** @var RecommendationStrategyInterface[] */
        private iterable $recommendationStrategies
    ) {}

    /**
     * @throws AlgorithmWithGivenIdNotExistsException
     */
    public function create(int $strategyId): RecommendationStrategyInterface
    {
        foreach ($this->recommendationStrategies as $recommendationStrategy) {
            if ($recommendationStrategy->supports($strategyId)) {
                return $recommendationStrategy;
            }
        }

        throw new AlgorithmWithGivenIdNotExistsException();
    }
}
