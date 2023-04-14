<?php

declare(strict_types=1);

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\Response;

final class EmptyResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
