<?php

declare(strict_types=1);

use Src\Domain\Catalog\Rating;

it('accepts a rating in range', function (): void {
    expect(new Rating(7.5)->toFloat())->toBe(7.5);
});

it('accepts the lower bound', function (): void {
    expect(new Rating(0.0)->toFloat())->toBe(0.0);
});

it('accepts the upper bound', function (): void {
    expect(new Rating(10.0)->toFloat())->toBe(10.0);
});

it('rejects negative rating', function (): void {
    new Rating(-0.1);
})->throws(InvalidArgumentException::class);

it('rejects rating above ten', function (): void {
    new Rating(10.1);
})->throws(InvalidArgumentException::class);

it('compares by value despite float quirks', function (): void {
    expect(new Rating(0.1 + 0.2)->equals(new Rating(0.3)))->toBeTrue();
});
