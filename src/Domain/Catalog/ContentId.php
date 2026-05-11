<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use InvalidArgumentException;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;

final readonly class ContentId
{
    public function __construct(private string $value)
    {
        if (!Uuid::fromString($value) instanceof UuidV7) {
            throw new InvalidArgumentException("ContentId must be UUID v7: {$value}");
        }
    }

    public static function generate(): self
    {
        return new self((string) Uuid::v7());
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
