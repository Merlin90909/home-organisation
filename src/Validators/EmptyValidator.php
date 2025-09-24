<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class EmptyValidator implements ValidatorInterface
{
    public function __construct()
    {
    }

    public function validate($input): bool
    {
        if ($input === '' || $input === null) {
            return false;
        } else {
            return true;
        }
    }

    public function getMessages(): array
    {
        // TODO: Implement getMessages() method.
    }
}