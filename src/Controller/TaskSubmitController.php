<?php

namespace App\Controller;

use App\Services\TaskCreateService;
use App\Services\TaskService;
use App\Services\RoomsService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Responses\HtmlResponse;
use Framework\Services\HtmlRenderer;

class TaskSubmitController implements ControllerInterface
{
    public function __construct(
        private TaskCreateService $taskCreateService,
        private RoomsService $roomsService,
        private HtmlRenderer $htmlRenderer,
        private TaskService $taskService,
    ) {
    }

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        $roomId = isset($post['room_id']) ? (int)$post['room_id'] : null;

        $create = $this->taskCreateService->create(
            $session['user_id'],
            $post['room_id'],
            $post['task_title'],
            $post['task_notes'],
            $post['task_due_at'],
            $post['task_priority'],
            $post['task_status'],
            $post['task_created_at']
        );

        if (!$create) {
            $room = $this->roomsService->getRoom($roomId);
            $task = $this->taskService->getTaskByRoomId($roomId);


            return new HtmlResponse($this->htmlRenderer->render('room.phtml', [
                'room' => $room,
                'task' => $task,
                'timers' => $task,
                'error' => 'creation_failed'
            ]));
        }

        $room = $this->roomsService->getRoom($roomId);
        $task = $this->taskService->getTaskByRoomId($roomId);

        return new HtmlResponse($this->htmlRenderer->render('room.phtml', [
            'room' => $room,
            'task' => $task,
            'timers' => $task,
            'success' => 'creation_success'
        ]));
    }
}