<?php

declare(strict_types=1);

namespace App\Application\Recommendation\Factory;

use App\Domain\Recommendation\Strategy\RecommendationStrategyInterface;

interface RecommendationStrategyFactoryInterface
{
    public function create(int $strategyId): RecommendationStrategyInterface;
}
