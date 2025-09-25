<?php

namespace App\Validators;

use Framework\Validators\PayloadValidator;
use Framework\Validators\ValidatorChain;

class LogInSubmitValidator extends PayloadValidator
{
    public function __construct(array $validators = [])
    {
        parent::__construct([
            'email' => new ValidatorChain([
                new NotEmptyValidator(),
                new MinLengthValidator(3)
            ]),
            'password' => new ValidatorChain([
                new NotEmptyValidator(),
                new MinLengthValidator(3)
            ])
        ]);
    }
}