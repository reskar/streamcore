<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use InvalidArgumentException;

final readonly class Duration
{
    public const int MIN = 1;
    public const int MAX = 1440;

    public function __construct(private int $minutes)
    {
        if ($minutes < self::MIN || $minutes > self::MAX) {
            throw new InvalidArgumentException(
                'Duration must be between ' . self::MIN . ' and ' . self::MAX . " minutes, got {$minutes}",
            );
        }
    }

    public function toMinutes(): int
    {
        return $this->minutes;
    }

    public function equals(self $other): bool
    {
        return $this->minutes === $other->minutes;
    }
}
