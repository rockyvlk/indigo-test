<?php

declare(strict_types=1);

namespace App\Http\Web;

use App\Auth\Validation\Hash\ValidHash;
use App\Auth\Validation\Login\AvailableLogin;
use App\Http\Request\RequestValidationInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class RegisterRequest implements RequestValidationInterface
{
    #[
        Assert\Type('string'),
        Assert\NotBlank
    ]
    public $first_name;

    #[
        Assert\Type('string'),
        Assert\NotBlank
    ]
    public $second_name;

    #[
        Assert\Type('string'),
        Assert\NotBlank,
        AvailableLogin
    ]
    public $login;

    #[
        Assert\Type('string'),
        Assert\NotBlank
    ]
    public $telegram_id;

    #[
        Assert\Type('string'),
        Assert\NotBlank,
        ValidHash
    ]
    public $hash;
}
