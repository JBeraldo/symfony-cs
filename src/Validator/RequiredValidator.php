<?php

namespace App\Validator;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class RequiredValidator
{
    public static function validate(mixed $value, ExecutionContextInterface $context, mixed $payload): void
    {
        dd(' asdasdasdasdads');
    }
}