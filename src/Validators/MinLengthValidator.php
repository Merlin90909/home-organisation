<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class minLengthValidator implements ValidatorInterface
{
    public function __construct(private int $minLenght)
    {
    }

    public function validate($input): bool
    {
        if (strlen($input) < $this->minLenght) {
            return false;
        } else {
            return true;
        }
    }
}