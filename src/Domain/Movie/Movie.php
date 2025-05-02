<?php

declare(strict_types=1);

namespace App\Domain\Movie;

readonly class Movie
{
    public function __construct(
        private string $title
    ) {}

    public function title(): string
    {
        return $this->title;
    }

    public function hasMultiWordTitle(): bool
    {
        return str_word_count($this->title) > 1;
    }

    public function hasTitleStartsWithWLetterAndHaveEvenLength(): bool
    {
        return str_starts_with($this->title, 'W') && mb_strlen($this->title) % 2 === 0;
    }
}
