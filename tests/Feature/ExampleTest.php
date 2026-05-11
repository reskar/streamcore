<?php

declare(strict_types=1);

it('responds to root', function () {
    $this->get('/')->assertOk();
});
