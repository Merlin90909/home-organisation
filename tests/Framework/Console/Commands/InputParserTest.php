<?php

namespace Test\Framework\Console\Commands;

use Framework\Console\InputParser;
use PHPUnit\Framework\TestCase;

class InputParserTest extends TestCase
{
    public function testParseWithEmptyInput(): void
    {
        $parser = new InputParser();

        $input = $parser->parse([]);

        $this->assertNull($input->getCommandName());
        $this->assertEmpty($input->getArguments());
        $this->assertEmpty($input->getOptions());
    }

}