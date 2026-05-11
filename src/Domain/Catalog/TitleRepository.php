<?php

declare(strict_types=1);

namespace Src\Domain\Catalog;

interface TitleRepository
{
    public function save(Title $title): void;

    public function findById(ContentId $id): ?Title;
}
