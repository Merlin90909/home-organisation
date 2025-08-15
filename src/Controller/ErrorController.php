<?php

class ErrorController implements ControllerInterface
{
    function handle( $post,  $get,  $server,  &$session): string
    {
        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('error.phtml', $_POST);

    }
}