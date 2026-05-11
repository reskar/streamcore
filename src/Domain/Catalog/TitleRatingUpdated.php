<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use Src\Domain\DomainEvent;

final readonly class TitleRatingUpdated implements DomainEvent
{
    public function __construct(
        public ContentId $id,
        public Rating $rating,
    ) {}
}
