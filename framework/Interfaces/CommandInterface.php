<?php

namespace Framework\Interfaces;

//name, Aliase
//execute MEthode
//alle BEfehle brauche invoke

use Framework\Console\Output;
use Framework\Enums\ExitCode;

interface CommandInterface
{
    public static function name(): string;

    public function __invoke(Output $output): ExitCode;

}