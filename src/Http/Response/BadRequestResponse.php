<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;

final class BadRequestResponse extends JsonResponse
{
    public function __construct(BadRequestException $exception)
    {
        parent::__construct(
            [
                'message' => $exception->getMessage(),
                'errors' => array_map(
                    static function (ConstraintViolation $constraint) {
                        return [
                            'message' => $constraint->getMessage(),
                            'field' => $constraint->getPropertyPath(),
                        ];
                    },
                    $exception->getConstraints()
                ),
            ],
            Response::HTTP_BAD_REQUEST
        );
        $this->setEncodingOptions(\JSON_UNESCAPED_UNICODE);
    }
}
