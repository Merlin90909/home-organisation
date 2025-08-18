<?php

class LogoutService
{
    function destroySession()
    {
        $destroySessionFlag = filter_input(INPUT_POST, 'destroySession');
        if ($destroySessionFlag == 1) {
            return session_destroy();
        }
        return '';
    }
}