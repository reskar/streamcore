<?php

declare(strict_types=1);

it('responds to root', function (): void {
    $this->get('/')->assertOk();
});
