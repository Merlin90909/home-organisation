<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class PasswordLengthValidator implements ValidatorInterface
{

    public function validate($input): bool
    {
        if (strlen($input) < 8) {
            return false;
        }
        if (strlen($input) > 32) {
            return false;
        }
        return true;
    }

    public function getMessages(): array
    {
        return [
            'Das Passwort ist nicht lang genug!'
        ];
    }
}