<?php

namespace App\Validators;

use Framework\Validators\PayloadValidator;
use Framework\Validators\ValidatorChain;

class WarehouseSubmitValidator extends PayloadValidator
{
    public function __construct(array $validators = [])
    {
        parent::__construct([
            'name' => new ValidatorChain([
                new NotEmptyValidator()
            ]),
            'category' => new ValidatorChain([
                new NotEmptyValidator()
            ]),
            'amount' => new ValidatorChain([
                new NotEmptyValidator()
            ])
        ]);
    }
}