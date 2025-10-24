<?php

namespace Framework\Services;

class LoggerService
{
    public function log(string $message)
    {
        $filePath = __DIR__ . '/../../data/logs/log.txt';

        $file = fopen($filePath, 'a');
        fwrite($file, $message."\n");
        fclose($file);
    }
}