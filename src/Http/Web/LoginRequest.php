<?php

declare(strict_types=1);

namespace App\Http\Web;

use App\Auth\Validation\Hash\ValidHash;
use App\Auth\Validation\Login\RegisteredLogin;
use App\Http\Request\RequestValidationInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class LoginRequest implements RequestValidationInterface
{
    #[
        Assert\Type('string'),
        Assert\NotBlank,
        RegisteredLogin
    ]
    public $login;


    #[
        Assert\Type('string'),
        Assert\NotBlank,
        ValidHash
    ]
    public $hash;
}
