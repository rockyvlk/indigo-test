<?php

declare(strict_types=1);

namespace App\Http\Api;

use App\Http\Request\RequestValidationInterface;

final class TelegramHookRequest implements RequestValidationInterface
{
    public $update_id;
    public $message;


}
