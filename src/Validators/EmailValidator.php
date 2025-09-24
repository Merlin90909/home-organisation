<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class EmailValidator implements ValidatorInterface
{
    public function __construct(
        private NotEmptyValidator $notEmptyValidator,
    ) {
    }

    public function validate($input): bool
    {
        $minLength = new MinLengthValidator(3);
        if ($this->notEmptyValidator->validate($input) &&
            $minLength->validate($input)) {
            return true;
        }
        return false;
    }

    public function getMessages(): array
    {
        // TODO: Implement getMessages() method.
    }
}