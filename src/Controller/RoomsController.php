<?php


class RoomsController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {
        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('rooms.phtml', $_POST);
    }
}