<?php

namespace App\Controller;

use App\Services\TaskService;
use App\Services\RoomsService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\HtmlResponse;
use Framework\Services\HtmlRenderer;

class TaskDeleteController implements ControllerInterface
{
    public function __construct(
        private TaskService $taskService,
        private HtmlRenderer $htmlRenderer,
        private RoomsService $roomsService
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        $taskId = (int)$httpRequest->getPayload()['task_id'];

        $roomId = (int)$httpRequest->getPayload()['room_id'];

        if ($taskId === null || $roomId === null) {
            $rooms = $this->roomsService->getRooms($httpRequest->getSession()['user_id']);

            return new HtmlResponse($this->htmlRenderer->render('rooms.phtml', [
                'rooms' => $rooms,
                'error' => 'missing_parameters'
            ]));
        }
        $this->taskService->deleteTaskById($taskId);

        $room = $this->roomsService->getRoom($roomId);

        if (!$room) {
            return new HtmlResponse($this->htmlRenderer->render('404.phtml', []));
        }

        $task = $this->taskService->getTaskByRoomId($roomId);

        return new HtmlResponse($this->htmlRenderer->render('room.phtml', [
            'room' => $room,
            'task' => $task,
            'timers' => $task,
        ]));
    }
}