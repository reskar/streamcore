<?php

declare(strict_types=1);

use Src\Domain\Catalog\ContentId;
use Src\Domain\Catalog\Duration;
use Src\Domain\Catalog\Rating;
use Src\Domain\Catalog\Slug;
use Src\Domain\Catalog\Title;
use Src\Domain\Catalog\TitleCreated;
use Src\Domain\Catalog\TitleRatingUpdated;
use Src\Domain\Catalog\Year;

it('exposes constructor attributes after create', function (): void {
    $id = ContentId::generate();
    $title = Title::create(
        $id,
        'Dune',
        new Slug('dune'),
        new Year(2021),
        new Duration(155),
        new Rating(8.0),
    );

    expect($title->id()->equals($id))->toBeTrue()
        ->and($title->name())->toBe('Dune')
        ->and($title->slug()->toString())->toBe('dune')
        ->and($title->year()->toInt())->toBe(2021)
        ->and($title->duration()->toMinutes())->toBe(155)
        ->and($title->rating()->toFloat())->toBe(8.0);
});

it('records TitleCreated on create', function (): void {
    $title = Title::create(
        ContentId::generate(),
        'Blade Runner 2049',
        new Slug('blade-runner-2049'),
        new Year(2017),
        new Duration(164),
        new Rating(8.0),
    );

    $events = $title->releaseEvents();

    expect($events)->toHaveCount(1)
        ->and($events[0])->toBeInstanceOf(TitleCreated::class);
});

it('updates rating and records event', function (): void {
    $title = Title::create(
        ContentId::generate(),
        'Arrival',
        new Slug('arrival'),
        new Year(2016),
        new Duration(116),
        new Rating(7.9),
    );
    $title->releaseEvents();

    $title->updateRating(new Rating(8.5));

    expect($title->rating()->toFloat())->toBe(8.5);

    $events = $title->releaseEvents();
    expect($events)->toHaveCount(1)
        ->and($events[0])->toBeInstanceOf(TitleRatingUpdated::class);
});

it('reconstitutes without recording events', function (): void {
    $title = Title::reconstitute(
        ContentId::generate(),
        'Old Movie',
        new Slug('old-movie'),
        new Year(2000),
        new Duration(120),
        new Rating(7.0),
    );

    expect($title->releaseEvents())->toBe([]);
});

it('releaseEvents empties the queue', function (): void {
    $title = Title::create(
        ContentId::generate(),
        'Some Title',
        new Slug('some-title'),
        new Year(2020),
        new Duration(90),
        new Rating(6.0),
    );
    $title->releaseEvents();

    expect($title->releaseEvents())->toBe([]);
});

it('rejects empty name', function (): void {
    Title::create(
        ContentId::generate(),
        '',
        new Slug('x'),
        new Year(2000),
        new Duration(60),
        new Rating(5.0),
    );
})->throws(InvalidArgumentException::class);

it('rejects name longer than 300 chars', function (): void {
    Title::create(
        ContentId::generate(),
        str_repeat('a', 301),
        new Slug('x'),
        new Year(2000),
        new Duration(60),
        new Rating(5.0),
    );
})->throws(InvalidArgumentException::class);
