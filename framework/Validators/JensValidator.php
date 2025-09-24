<?php

namespace Framework\Validators;

class JensValidator
{
    public function validateIfInputIsJens(string $input): bool
    {
        if ($input === 'Jens' || $input === 'jens') {
            return true;
        }

        return false;
    }

}