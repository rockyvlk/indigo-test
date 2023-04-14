<?php

declare(strict_types=1);

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InternalServerErrorResponse extends JsonResponse
{
    public function __construct()
    {
        parent::__construct(
            [
                'message' => 'Что-то сломалось...',
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
        $this->setEncodingOptions(\JSON_UNESCAPED_UNICODE);
    }
}
