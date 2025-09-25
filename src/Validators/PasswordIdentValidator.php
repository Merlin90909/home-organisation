<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class PasswordIdentValidator implements ValidatorInterface
{

    public function validate($input): bool
    {
        if ($input) {
            return true;
        }
        return false;
    }

    public function getMessages(): array
    {
        return [
            'Die Passwörter stimmen nicht überein!'
        ];
    }
}