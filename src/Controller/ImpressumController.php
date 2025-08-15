<?php

class ImpressumController implements ControllerInterface
{
    function handle( $post,  $get,  $server,  &$session): string
    {
        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('impressum.phtml', $_POST);

    }
}