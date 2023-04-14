<?php

declare(strict_types=1);

namespace App\Auth\Read\Link;

enum State: string
{
    case Wait = 'wait';
    case Used = 'used';
}
