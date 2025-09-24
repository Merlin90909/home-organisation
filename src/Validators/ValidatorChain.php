<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class ValidatorChain implements ValidatorInterface
{
    private array $errors = [];

    public function __construct(
        private readonly array $validators,
        private readonly bool $abortOnFailure = false
    ) {
    }

    public function validate($input): bool
    {
        $success = true;

        foreach ($this->validators as $validator) {
            if (!$validator->validate($input)) {
                $success = false;
                $this->errors = array_merge($this->errors, $validator->getMessages());

                if ($this->abortOnFailure) {
                    return false;
                }
            }
        }

        return $success;
    }

    public function getMessages(): array
    {
        return $this->errors;
    }
}