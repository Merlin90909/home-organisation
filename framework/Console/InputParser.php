<?php

namespace Framework\Console;

use Framework\Dtos\InputArgumentDto;
use Framework\Dtos\InputOptionDto;

class  InputParser
{

    public function parse(array $arguments): Input
    {
        array_shift($arguments);
        $commandName = array_shift($arguments);

        $inputArguments = [];
        $options = [];

        foreach ($arguments as $argument) {
            if (str_starts_with($argument, '--')) {
                $name = substr($argument, 2);
                if (str_contains($argument, '=')) {
                    [$name, $val] = explode('=', $name, 2);
                    //überprüfen ob name unter den Optionen ist(getDefinition)
                } else {
                    $val = 'true';
                }
                //das fällt weg; Dto aus getDefinition benutzen und value hinzufügen
                //$value gleich wert wie grün oder blau
                //statt new Dto dieses Dto mit Value in option[name[
                $options[$name] = new InputOptionDto(
                    $name,
                    '',
                    $val,
                    null,
                    null
                );
            } elseif (str_starts_with($argument, '-')) {
                $name = substr($argument, 1);
                if (str_contains($argument, '=')) {
                    [$name, $val] = explode('=', $name, 2);
                } else {
                    $val = 'true';
                }

                $options[$name] = new InputOptionDto(
                    $name,
                    '',
                    $val,
                    $name,
                    null
                );
            } else {
                $inputArguments[$argument] = new InputArgumentDto(
                    $argument,
                    '',
                    true
                );
            }
        }
        $input = new Input();
        $input->setCommandName($commandName);
        $input->setArguments($inputArguments);
        $input->setOptions($options);

        return $input;
    }

}