<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use InvalidArgumentException;

final readonly class Rating
{
    public const float MIN = 0.0;
    public const float MAX = 10.0;

    private int $tenths;

    public function __construct(float $value)
    {
        if ($value < self::MIN || $value > self::MAX) {
            throw new InvalidArgumentException(
                'Rating must be between ' . self::MIN . ' and ' . self::MAX . ", got {$value}",
            );
        }

        $this->tenths = (int) round($value * 10);
    }

    public function toFloat(): float
    {
        return $this->tenths / 10;
    }

    public function equals(self $other): bool
    {
        return $this->tenths === $other->tenths;
    }
}
