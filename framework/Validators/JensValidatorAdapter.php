<?php

namespace Framework\Validators;

use Framework\Interfaces\ValidatorInterface;
use Framework\Services\ObjectManagerService;

class JensValidatorAdapter implements ValidatorInterface
{
    public function __construct(private JensValidator $jensValidator)
    {
    }

    public function validate($input): bool
    {
        return $this->jensValidator->validateIfInputIsJens($input);

    }

    public function getMessages(): array
    {
        return [
            'Kein Jens!'
        ];
    }
}