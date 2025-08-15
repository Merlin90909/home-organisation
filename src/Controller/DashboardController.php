<?php

require_once __DIR__ . '/../Services/htmlRenderer.php';

class DashboardController implements ControllerInterface
{

    function handle($post,  $get,  $server,  &$session): string
    {
        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('home.phtml', $post);

    }

}