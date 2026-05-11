<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use Src\Domain\DomainEvent;

final readonly class TitleCreated implements DomainEvent
{
    public function __construct(
        public ContentId $id,
        public string $name,
        public Slug $slug,
        public Year $year,
        public Duration $duration,
        public Rating $rating,
    ) {}
}
