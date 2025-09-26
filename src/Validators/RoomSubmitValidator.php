<?php

namespace App\Validators;

use Framework\Validators\PayloadValidator;
use Framework\Validators\ValidatorChain;

class RoomSubmitValidator extends PayloadValidator
{
    public function __construct(array $validators = [])
    {
        parent::__construct([
            'title' => new ValidatorChain([
                new NotEmptyValidator()
            ]),
            'notes' => new ValidatorChain([
                new NotEmptyValidator(),
            ])
        ]);
    }

}