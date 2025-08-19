<?php

class RegisterSubmitController implements ControllerInterface
{

    function handle($post, $get, $server, &$session): string
    {
        $RegisterService = new RegisterService();
        $register = $RegisterService->register(
            $post['fName'],
            $post['lName'],
            $post['email'],
            $post['password'],
            $post['password2']
        );

        if (!$register) {
            header('location: /register?error=register_failed');
            exit;
        }
        header('location: /login?register=success');
        return '';
    }
}