<?php

namespace App\Controller;

class RoomsController implements ControllerInterface
{
    public function __construct(
        private RoomsService $roomsService,
        private HtmlRenderer $htmlRenderer
    ) {
    }

    function handle($post, $get, $server, &$session): string
    {
        $rooms = $this->roomsService->getRooms();

        return $this->htmlRenderer->render('rooms.phtml', [
            'rooms' => $rooms
        ]);
    }
}