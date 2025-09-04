<?php

namespace App\Controller;

use App\Interfaces\ControllerInterface;
use App\Interfaces\ResponseInterface;
use Framework\Responses\RedirectResponse;

class LogoutSubmitController implements ControllerInterface
{

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        if (!empty($post['destroySession'])) {
            $_SESSION = [];
            session_destroy();
            return new RedirectResponse('login');
        }
        //return '';
    }
}