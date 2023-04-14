<?php

declare(strict_types=1);

namespace App\Http\Exception;

use App\Http\Response\AccessDeniedResponse;
use App\Http\Response\BadRequestResponse;
use App\Http\Response\DomainExceptionResponse;
use App\Http\Response\HttpErrorResponse;
use App\Http\Response\InternalServerErrorResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class ExceptionListener
{
    public function __construct(private readonly string $env)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof BadRequestException) {
            $event->setResponse(new BadRequestResponse($exception));
        } elseif ('dev' !== $this->env) {
            $event->setResponse(new InternalServerErrorResponse());
        }
    }
}
