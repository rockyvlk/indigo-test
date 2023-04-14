<?php

declare(strict_types=1);

namespace App\Http\Response;

use DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class DomainExceptionResponse extends JsonResponse
{
    public function __construct(DomainException $exception)
    {
        parent::__construct(
            [
                'message' => $exception->getMessage(),
            ],
            Response::HTTP_BAD_REQUEST
        );
        $this->setEncodingOptions(\JSON_UNESCAPED_UNICODE);
    }
}
