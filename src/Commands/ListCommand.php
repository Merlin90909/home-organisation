<?php

namespace App\Commands;

use Framework\Console\CommandFinder;
use Framework\Console\ConsoleApplication;
use Framework\Console\Input;
use Framework\Console\Output;
use Framework\Dtos\DirectoryLocationDto;
use Framework\Dtos\InputDefinitionDto;
use Framework\Dtos\InputOptionDto;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class ListCommand implements CommandInterface
{
    public array $commands = [];

    public static function name(): string
    {
        return 'list';
    }

    public function __invoke(Input $input, Output $output): ExitCode
    {
        $output->writeLine('--Alle verfügbaren Commands:--');
        $output->writeNewLine();

        $options = $input->getOptions() ?? null;
        $filter = $options[0] ?? null;
        $filterValue = $filter->value ?? null;
        $finder = new CommandFinder();

        $return_value = match ($filterValue) {
            'app', 'src' => $finder->find([new DirectoryLocationDto(__DIR__ . '/../../src', 'App')]),
            'framework' => $finder->find([new DirectoryLocationDto(__DIR__ . '/../../framework', 'Framework')]),
            'default' => $finder->find([
                new DirectoryLocationDto(__DIR__ . '/../../src', 'App'),
                new DirectoryLocationDto(__DIR__ . '/../../framework', 'Framework')
            ])
        };

        foreach ($return_value as $commandName => $command) {
            $output->writeLine(
                " - " . $commandName . "  =>\t" . $command['description']
            );
            $output->writeNewLine();
        }

        return ExitCode::Success;
    }

    public function getDefinition(): InputDefinitionDto
    {
        return new InputDefinitionDto()
            ->addOption(
                new InputOptionDto(
                    'filter',
                    'filter',
                    null,
                    '-sf',
                    null
                )
            );
    }

    public static function description(): string
    {
        return 'a list of all commands';
    }
}