<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class NameValidator implements ValidatorInterface
{

    public function validate($input): bool
    {
        if (!preg_match('/[A-Z,a-z]/', $input)) {
            return false;
        }
        return true;
    }
}