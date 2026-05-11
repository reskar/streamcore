<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use InvalidArgumentException;

final readonly class Year
{
    public const int MIN = 1888;
    public const int MAX = 2100;

    public function __construct(private int $value)
    {
        if ($value < self::MIN || $value > self::MAX) {
            throw new InvalidArgumentException(
                'Year must be between ' . self::MIN . ' and ' . self::MAX . ", got {$value}",
            );
        }
    }

    public function toInt(): int
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
