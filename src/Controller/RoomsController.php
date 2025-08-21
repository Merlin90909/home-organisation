<?php


class RoomsController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {
        $service = new RoomsService();
        $rooms = $service->getRooms();

        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('rooms.phtml', [
            'rooms' => $rooms
        ]);
    }
}