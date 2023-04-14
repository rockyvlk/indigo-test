<?php

declare(strict_types=1);

namespace App\Auth\Domain\Link;

enum State: string
{
    case Wait = 'wait';
    case Used = 'used';
}
