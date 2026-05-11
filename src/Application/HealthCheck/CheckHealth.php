<?php

declare(strict_types=1);

namespace Src\Application\HealthCheck;

use Src\Domain\Health\HealthStatus;

final class CheckHealth
{
    public function __invoke(): HealthStatus
    {
        return HealthStatus::Ok;
    }
}
