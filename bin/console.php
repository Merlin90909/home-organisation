<?php
//Startpunkt
//an vendor und index orientieren

use Framework\Console\ConsoleApplication;

require_once __DIR__ . '/../vendor/autoload.php';

$exitCode = new ConsoleApplication()->boot(__DIR__ . '/../src')->run();

exit($exitCode->value);