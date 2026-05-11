<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

use InvalidArgumentException;
use Src\Domain\DomainEvent;

use function strlen;

final class Title
{
    public const int NAME_MAX_LENGTH = 300;

    /** @var list<DomainEvent> */
    private array $events = [];

    private function __construct(
        private readonly ContentId $id,
        private readonly string $name,
        private readonly Slug $slug,
        private readonly Year $year,
        private readonly Duration $duration,
        private Rating $rating,
    ) {
        $length = strlen($name);

        if ($length === 0 || $length > self::NAME_MAX_LENGTH) {
            throw new InvalidArgumentException(
                'Title name must be 1..' . self::NAME_MAX_LENGTH . " chars, got {$length}",
            );
        }
    }

    public static function create(
        ContentId $id,
        string $name,
        Slug $slug,
        Year $year,
        Duration $duration,
        Rating $rating,
    ): self {
        $title = new self($id, $name, $slug, $year, $duration, $rating);
        $title->record(new TitleCreated($id, $name, $slug, $year, $duration, $rating));

        return $title;
    }

    public static function reconstitute(
        ContentId $id,
        string $name,
        Slug $slug,
        Year $year,
        Duration $duration,
        Rating $rating,
    ): self {
        return new self($id, $name, $slug, $year, $duration, $rating);
    }

    public function id(): ContentId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): Slug
    {
        return $this->slug;
    }

    public function year(): Year
    {
        return $this->year;
    }

    public function duration(): Duration
    {
        return $this->duration;
    }

    public function rating(): Rating
    {
        return $this->rating;
    }

    public function updateRating(Rating $rating): void
    {
        $this->rating = $rating;
        $this->record(new TitleRatingUpdated($this->id, $rating));
    }

    /** @return list<DomainEvent> */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    private function record(DomainEvent $event): void
    {
        $this->events[] = $event;
    }
}
