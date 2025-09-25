<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class PasswordSpecialCharValidator implements ValidatorInterface
{

    public function validate($input): bool
    {
        if (!preg_match('/[!?,._-]/', $input)) {
            return false;
        }
        return true;
    }

    public function getMessages(): array
    {
        return [
            'Das Passwort muss ein Sonderzeichen enthalten!'
        ];
    }
}