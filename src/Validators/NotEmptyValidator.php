<?php

namespace App\Validators;

use Framework\Interfaces\ValidatorInterface;

class NotEmptyValidator implements ValidatorInterface
{

    public function validate($input): bool
    {
        if (empty($input)) {
            return false;
        }else{
            return true;
        }
    }
}