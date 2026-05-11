<?php

declare(strict_types=1);

use Src\Domain\Catalog\Duration;

it('accepts a valid duration in minutes', function (): void {
    expect(new Duration(120)->toMinutes())->toBe(120);
});

it('accepts the lower bound', function (): void {
    expect(new Duration(1)->toMinutes())->toBe(1);
});

it('accepts the upper bound', function (): void {
    expect(new Duration(1440)->toMinutes())->toBe(1440);
});

it('rejects zero', function (): void {
    new Duration(0);
})->throws(InvalidArgumentException::class);

it('rejects negative duration', function (): void {
    new Duration(-1);
})->throws(InvalidArgumentException::class);

it('rejects duration longer than a day', function (): void {
    new Duration(1441);
})->throws(InvalidArgumentException::class);

it('compares by value', function (): void {
    expect(new Duration(90)->equals(new Duration(90)))->toBeTrue();
});
