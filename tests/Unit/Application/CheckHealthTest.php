<?php

declare(strict_types=1);

use Src\Application\HealthCheck\CheckHealth;
use Src\Domain\Health\HealthStatus;

it('returns ok', function () {
    $check = new CheckHealth();

    expect($check())->toBe(HealthStatus::Ok);
});
