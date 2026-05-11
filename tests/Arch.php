<?php

declare(strict_types=1);

arch('domain has no laravel dependencies')
    ->expect('Src\Domain')
    ->not->toUse('Illuminate');

arch('application has no laravel dependencies')
    ->expect('Src\Application')
    ->not->toUse('Illuminate');

arch('domain has no eloquent dependencies')
    ->expect('Src\Domain')
    ->not->toUse(\Illuminate\Database\Eloquent\Model::class);

arch('classes in src are strict')
    ->expect('Src')
    ->toUseStrictTypes();
