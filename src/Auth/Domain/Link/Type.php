<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

enum Type: string
{
    case Register = 'register';
    case Authorization = 'authorization';
}
