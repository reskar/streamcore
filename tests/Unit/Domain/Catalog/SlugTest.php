<?php

declare(strict_types=1);

use Src\Domain\Catalog\Slug;

it('accepts lowercase alphanumeric with dashes', function (): void {
    expect(new Slug('my-content-2026')->toString())->toBe('my-content-2026');
});

it('rejects empty string', function (): void {
    new Slug('');
})->throws(InvalidArgumentException::class);

it('rejects uppercase letters', function (): void {
    new Slug('My-Content');
})->throws(InvalidArgumentException::class);

it('rejects special characters', function (): void {
    new Slug('my content!');
})->throws(InvalidArgumentException::class);

it('rejects leading or trailing dashes', function (): void {
    new Slug('-bad-');
})->throws(InvalidArgumentException::class);

it('rejects consecutive dashes', function (): void {
    new Slug('a--b');
})->throws(InvalidArgumentException::class);

it('compares by value', function (): void {
    expect(new Slug('same')->equals(new Slug('same')))->toBeTrue();
});
