<?php

declare(strict_types=1);

it('reports ok on health endpoint', function (): void {
    $this->getJson('/health')
        ->assertOk()
        ->assertExactJson(['status' => 'ok']);
});
