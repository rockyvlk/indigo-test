<?php

declare(strict_types=1);

namespace App\Auth\Services\Link;

interface LinkCleanerInterface
{
    public function clean(): void;
}
