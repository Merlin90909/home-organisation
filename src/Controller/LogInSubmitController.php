<?php

class LogInSubmitController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {
        $LoginService = new LoginService();
        $isLoggedin = $LoginService->login($post['email'], $post['password']);

        if (!$isLoggedin) {
            header('Location: /login?error=login_failed');
            return '';
        }
        header('Location: /');
        return '';
    }
}