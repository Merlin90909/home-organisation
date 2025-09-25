<?php

namespace App\Validators;

use Framework\Validators\PayloadValidator;
use Framework\Validators\ValidatorChain;

class RegisterSubmitValidator extends PayloadValidator
{
    public function __construct(array $validators = [])
    {
        parent::__construct([
            'fName' => new ValidatorChain([
                new MinLengthValidator(3),
                new NotEmptyValidator()
            ]),
            'lName' => new ValidatorChain([
                new MinLengthValidator(3),
                new NotEmptyValidator()
            ]),
            'email' => new ValidatorChain([
                new NotEmptyValidator()
            ]),
            'password' => new ValidatorChain([
                new NotEmptyValidator(),
                new PasswordLengthValidator(),
                new  PasswordSpecialCharValidator()
            ]),
            'password2' => new ValidatorChain([
                new NotEmptyValidator(),
                //noch fertigstellen
                new PasswordIdentValidator()
            ])
        ]);
    }
}