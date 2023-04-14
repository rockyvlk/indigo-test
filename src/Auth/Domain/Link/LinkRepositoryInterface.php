<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

interface LinkRepositoryInterface
{
    public function get(Id $id): Link;
    public function save(Link $link): void;
}
