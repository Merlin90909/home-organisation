<?php

namespace Test\Framework\Console\Commands;

use Framework\Console\ConsoleApplication;
use Framework\Dtos\DirectoryLocationDto;
use Framework\Enums\ExitCode;
use PHPUnit\Framework\TestCase;

class ConsoleApplicationTest extends TestCase
{
    public function testBoot(): void
    {
        $app = new ConsoleApplication();
        $direction = new DirectoryLocationDto('', 'Test\\Namespace');
        $result = $app->boot($direction);

        $this->assertInstanceOf(ConsoleApplication::class, $result);
        $this->assertIsArray($app->commands);

    }


    public function testRunWithoutCommand(): void
    {
        $_SERVER['argv'] = ['console.php'];

        $app = new ConsoleApplication();
        $app->commands = [];

        $result = $app->run();

        $this->assertSame(ExitCode::Error, $result);
    }

    public function testRunCommandNotFound(): void
    {
        $_SERVER['argv'] = ['console.php', 'unknown:command'];

        $app = new ConsoleApplication();
        $app->commands = [];

        $result = $app->run();

        $this->assertSame(ExitCode::Error, $result);
    }
}