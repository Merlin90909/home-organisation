<?php

namespace App\Commands;

use Framework\Console\CommandFinder;
use Framework\Console\ConsoleApplication;
use Framework\Console\Input;
use Framework\Console\Output;
use Framework\Dtos\DirectoryLocationDto;
use Framework\Dtos\InputArgumentDto;
use Framework\Dtos\InputDefinitionDto;
use Framework\Dtos\InputOptionDto;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;
use Framework\Interfaces\RequireCommandInterface;

class ListCommand implements CommandInterface, RequireCommandInterface
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

        $options = $input->getOptions();

        $finder = new CommandFinder();

        if (isset($options['app'])) {
            $this->commands = $finder->find([
                new DirectoryLocationDto(__DIR__ . '/../../src', 'App')
            ]);
        }
        elseif (isset($options['framework'])) {
            $this->commands = $finder->find([
                new DirectoryLocationDto(__DIR__ . '/../../framework', 'Framework')
            ]);
        }
        else {
            $this->commands = $finder->find([
                new DirectoryLocationDto(__DIR__ . '/../../src', 'App'),
                new DirectoryLocationDto(__DIR__ . '/../../framework', 'Framework')
            ]);
        }

        $commands = array_keys($this->commands);

        foreach ($commands as $commandName) {
            $output->writeLine(" - " . $commandName . "  =>\t" . $this->commands[$commandName]['description']);
            $output->writeNewLine();
        }

        return ExitCode::Success;
    }

    public function getDefinition(): InputDefinitionDto
    {
        return new InputDefinitionDto()->addArgument(
            new InputArgumentDto(
                'list',
                'a list of the commands in the location',
                true
            )
        )
            ->addOption(
                new InputOptionDto(
                    'framework',
                    'framework data',
                    null,
                    '-sf',
                    null
                )
            )
            ->addOption(
                new InputOptionDto(
                    'app',
                    'app data',
                    null,
                    '-af',
                    null
                )
            );
    }

    public static function description(): string
    {
        return 'a list of all commands';
    }

    //ToDo: fertigstellen;
    public function getParameter(): null
    {

    }

    public function setParameter(): null
    {
        $console = new ConsoleApplication();

        //commands ziehen
        //überprüfen, wenn Interface implementiert

    }
}