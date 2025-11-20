<?php

namespace Framework\Console\Commands;

use Framework\Console\Input;
use Framework\Console\Output;
use Framework\Dtos\InputDefinitionDto;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class HelpCommand implements CommandInterface
{

    public static function name(): string
    {
        return 'help';
    }

    public static function description(): string
    {
        return 'show the desdcription of the command';
    }

    public function getDefinition(): InputDefinitionDto
    {
        return new InputDefinitionDto();
    }

    public function __invoke(Input $input, Output $output): ExitCode
    {

    }
}