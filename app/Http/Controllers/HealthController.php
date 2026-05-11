<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\HealthCheck\CheckHealth;

final class HealthController
{
    public function __invoke(CheckHealth $check): JsonResponse
    {
        return new JsonResponse(['status' => $check()->value]);
    }
}
