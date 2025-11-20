<?php

namespace App\Commands;

use Framework\Console\Input;
use Framework\Console\Output;
use Framework\Dtos\InputArgumentDto;
use Framework\Dtos\InputDefinitionDto;
use Framework\Dtos\InputOptionDto;
use Framework\Enums\Color;
use Framework\Enums\ExitCode;
use Framework\Interfaces\CommandInterface;

class TestCommand implements CommandInterface
{

    public static function name(): string
    {
        return 'test';
    }

    public function __invoke(Input $input, Output $output): ExitCode
    {
        //dd($input);
        $options = $input->getOptions();

        $text = 'Das ist ein Test!';

        $output->textFormat(Color::toArray()[$options[0]->value]);

        $output->writeLine($text);
        $output->writeNewLine();

        return ExitCode::Success;
    }

    public function getDefinition(): InputDefinitionDto
    {
        return new InputDefinitionDto()->addArgument(
            new InputArgumentDto(
                'test',
                'just a testcommand',
                true
            )
        )
            ->addOption(
                new InputOptionDto(
                    'format',
                    'format color',
                    null,
                    '-f',
                    null
                )
            );
    }

    public static function description(): string
    {
        return 'just a test';
    }
}