<?php

namespace App\Validators;

use Framework\Validators\PayloadValidator;
use Framework\Validators\ValidatorChain;

class RoomsSubmitValidator extends PayloadValidator
{
    public function __construct(array $validators = [])
    {
        parent::__construct([
            'room_name' => new ValidatorChain([
                new NotEmptyValidator()
            ]),
            'room_description' => new ValidatorChain([
                new NotEmptyValidator()
            ])
        ]);
    }
}