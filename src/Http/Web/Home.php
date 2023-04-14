<?php

declare(strict_types=1);

namespace App\Http\Web;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[
    Route(
        path: '/',
        name: 'home',
        methods: ['GET']
    ),
    Template('home.html.twig')
]
final class Home
{
    public function __invoke(#[CurrentUser] $user, RequestStack $requestStack): array
    {
        return [];
    }
}
