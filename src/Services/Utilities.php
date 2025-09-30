<?php

namespace App\Services;

class Utilities
{
    public static function flashMessage(string $key, string $message): void
    {
        if (!isset($_SESSION['flashMessages'][$key]) || !is_array($_SESSION['flashMessages'][$key])) {
            $_SESSION['flashMessages'][$key] = [];
        }
        $_SESSION['flashMessages'][$key][] = $message;
    }

    public static function getFlashMessages(): array
    {
        if (!isset($_SESSION['flashMessages']) || !is_array($_SESSION['flashMessages']) || empty($_SESSION['flashMessages'])) {
            return [];
        }
        $messages = $_SESSION['flashMessages'];
        $_SESSION['flashMessages'] = [];
        return $messages;
    }

}