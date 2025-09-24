<?php

namespace Framework\Validators;

use Framework\Interfaces\ValidatorInterface;

class PayloadValidator implements ValidatorInterface
{
    private array $errors = [];

    public function __construct(private readonly array $validators =[])
    {
    }

    public function validate($input): bool
    {
        $allValid = true;
        foreach ($this->validators as $field => $validator) {
            if (!array_key_exists($field, $input)) {
                $allValid = false;
                continue;
            }

            $value = $input[$field];

            if (!$validator->validate($value)) {
                $allValid = false;
                $this->errors = array_merge($this->errors, $validator->getMessages());
            }
        }

        return $allValid;
    }

    public function getMessages(): array
    {
        return $this->errors;
    }
}