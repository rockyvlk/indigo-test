<?php

declare(strict_types=1);

namespace App\Auth\Domain\User;

final class User
{
    public function __construct(
        private Id $id,
        private Name $name,
        private Login $login,
        private TelegramId $telegramId,
    ) {

    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getLogin(): Login
    {
        return $this->login;
    }

    public function getTelegramId(): TelegramId
    {
        return $this->telegramId;
    }
}
