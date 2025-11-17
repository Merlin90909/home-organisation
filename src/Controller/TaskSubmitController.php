<?php

namespace App\Controller;

use App\Services\TaskCreateService;
use App\Validators\TaskSubmitValidator;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\RedirectResponse;

class TaskSubmitController implements ControllerInterface
{
    public function __construct(
        private TaskCreateService $taskCreateService,
        private TaskSubmitValidator $payloadValidator,
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        $roomId = isset($httpRequest->getPayload()['room_id']) ? (int)$httpRequest->getPayload()['room_id'] : null;
        $valid = $this->payloadValidator->validate($httpRequest->getPayload());
        if (!$valid) {
            $allErrors = $this->payloadValidator->getMessages();

            foreach ($allErrors as $field => $messages) {
                foreach ($messages as $message) {
                    $_SESSION['flashMessages'][$field][] = $message;
                }
            }

            return new RedirectResponse("/room/{$roomId}");
        }

        $create = $this->taskCreateService->create(
            $httpRequest->getSession()['user_id'],
            $httpRequest->getPayload()['room_id'],
            $httpRequest->getPayload()['task_title'],
            $httpRequest->getPayload()['task_notes'],
            $httpRequest->getPayload()['task_due_at'],
            $httpRequest->getPayload()['task_priority'],
            $httpRequest->getPayload()['task_repeat'],
            $httpRequest->getPayload()['task_repeat_rule'],
            $httpRequest->getPayload()['task_created_at']
        );

        if (!$create) {
            return new RedirectResponse("/room/{$roomId}");
        }

        return new RedirectResponse("/room/{$roomId}");
    }
}