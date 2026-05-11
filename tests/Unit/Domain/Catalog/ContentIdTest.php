<?php

declare(strict_types=1);

use Src\Domain\Catalog\ContentId;

it('wraps a uuid v7 string', function (): void {
    $uuid = '01928e3a-7b8c-7234-9abc-def012345678';

    expect(new ContentId($uuid)->toString())->toBe($uuid);
});

it('rejects malformed strings', function (): void {
    new ContentId('not-a-uuid');
})->throws(InvalidArgumentException::class);

it('rejects non-v7 uuids', function (): void {
    new ContentId('550e8400-e29b-41d4-a716-446655440000');
})->throws(InvalidArgumentException::class);

it('generates a fresh v7 uuid', function (): void {
    $a = ContentId::generate();
    $b = ContentId::generate();

    expect($a->equals($b))->toBeFalse()
        ->and($a->toString())->not->toBe($b->toString());
});

it('compares by value', function (): void {
    $uuid = '01928e3a-7b8c-7234-9abc-def012345678';

    expect(new ContentId($uuid)->equals(new ContentId($uuid)))->toBeTrue();
});
