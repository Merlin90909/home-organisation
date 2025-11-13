<?php

namespace App\Commands;

use Framework\Console\Output;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class TestCommand implements CommandInterface
{

    public static function name(): string
    {
        return 'test';
    }

    public function __invoke(Output $output): ExitCode
    {
        $output->writeLine('Das ist ein Test!');
        $output->writeNewLine();

        return ExitCode::Success;
    }
}