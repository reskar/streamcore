<?php

declare(strict_types=1);

use Src\Domain\Catalog\Year;

it('accepts year in valid range', function (): void {
    expect(new Year(2024)->toInt())->toBe(2024);
});

it('accepts the lower bound', function (): void {
    expect(new Year(1888)->toInt())->toBe(1888);
});

it('accepts the upper bound', function (): void {
    expect(new Year(2100)->toInt())->toBe(2100);
});

it('rejects year before cinema existed', function (): void {
    new Year(1887);
})->throws(InvalidArgumentException::class);

it('rejects year too far in the future', function (): void {
    new Year(2101);
})->throws(InvalidArgumentException::class);

it('compares by value', function (): void {
    expect(new Year(2024)->equals(new Year(2024)))->toBeTrue();
});
