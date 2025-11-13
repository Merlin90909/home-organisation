<?php

namespace App\Commands;

use Framework\Console\Output;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class ListCommand implements CommandInterface
{

    public static function name(): string
    {
        return 'list';
    }

    public function __invoke(Output $output): ExitCode
    {
        // TODO: Implement __invoke() method.
    }
}