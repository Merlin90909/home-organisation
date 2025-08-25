<?php

class RoomController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {
        $roomService = new RoomsService();

        $id = isset($get['id']) && ctype_digit((string)$get['id']) ? (int)$get['id'] : null;
        if ($id === null) {
            header("Location: /rooms");
            exit;
        }
        $room = $roomService->getRoom($id);

        if (!$room) {
            header("Location: /404");
        }

        $htmlRenderer = new htmlRenderer();
        return $htmlRenderer->render('room.phtml', [
            'room' => $room,
        ]);
    }
}