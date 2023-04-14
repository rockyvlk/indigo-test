<?php

declare(strict_types=1);

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ResourceNotFoundResponse extends JsonResponse
{
    public function __construct(string $message = 'Ресурс не найден')
    {
        parent::__construct(
            [
                'message' => $message,
            ],
            404
        );
        $this->setEncodingOptions(\JSON_UNESCAPED_UNICODE);
    }
}
