<?php

declare(strict_types=1);

namespace App\Http\Request;

use App\Http\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RequestResolver implements ValueResolverInterface
{
    public function __construct(private ValidatorInterface $validator, private ObjectNormalizer $normalizer)
    {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_subclass_of((string) $argument->getType(), RequestValidationInterface::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        /**
         * @var class-string<RequestValidationInterface> $class
         */
        $class = $argument->getType();

        $data = $request->query->all();
        if ('' !== $request->getContent()) {
            $data = array_merge($data, $request->toArray());
        }

        $requestDto = $this->normalizer->denormalize($data, $class, 'array', [
            AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
        ]);

        $violations = $this->validator->validate($requestDto);

        if (count($violations) > 0) {
            throw new BadRequestException($violations);
        }

        yield $requestDto;
    }
}
