<?php

error_reporting(E_ALL & ~E_DEPRECATED);
require_once __DIR__ . '/../vendor/autoload.php';

use GO\Scheduler;

$scheduler = new Scheduler();

$scheduler
    ->php(__DIR__ . '/console.php', 'knockOff -show=now')
    //->at('14 8-17 * * *')
    ->at('* * * * *')
    ->output(__DIR__ . '/../data/logs/schedulerOutput.log');

$scheduler->run();
