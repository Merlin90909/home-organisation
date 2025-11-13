<?php

use Framework\Console\ConsoleApplication;

require_once __DIR__ . '/../vendor/autoload.php';

$console = new ConsoleApplication()->boot(__DIR__ . '/../src', 'App')->run();

exit($console->value);