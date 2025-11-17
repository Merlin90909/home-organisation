<?php

namespace Test\Framework\Console\Commands;

use Framework\Console\Output;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class TestCommand implements CommandInterface
{

    public static function name(): string
    {
        return 'fake';
    }

    public function __invoke(Output $output): ExitCode
    {
        $output->writeLine('Das ist ein Test!');
        $output->writeNewLine();

        return ExitCode::Success;
    }
}