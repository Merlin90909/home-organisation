<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class Listvalidator implements ValidatorInterface
{
    public function __construct(private string $type)
    {
    }

    public function validate($input): bool
    {
        foreach ($input as $item) {
            if (!is_type($item, $this->type)) {
                return false;
            }
        }

        return true;
    }

    public function getMessages(): array
    {
        return [
            'Falscher Typ!'
        ];
    }
}