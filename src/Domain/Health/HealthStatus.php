<?php

declare(strict_types=1);

namespace Src\Domain\Health;

enum HealthStatus: string
{
    case Ok = 'ok';
    case Down = 'down';
}
