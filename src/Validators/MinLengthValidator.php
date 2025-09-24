<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class MinLengthValidator implements ValidatorInterface
{
    public function __construct(private int $minLength)
    {
    }

    public function validate($input): bool
    {
        if (strlen($input) < $this->minLength) {
            return false;
        } else {
            return true;
        }
    }

    public function getMessages(): array
    {
        return [
            'Die Eingabe ist zu kurz!'
        ];
    }
}