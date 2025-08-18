<?php


class LogoutSubmitController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {

        if ($post['destroySession']) {
            session_destroy();
            header('Location: /login');
            return '';
        }
        return '';
    }
}