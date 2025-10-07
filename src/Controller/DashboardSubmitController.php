<?php

namespace App\Controller;

use App\Services\DashboardService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\RedirectResponse;

class DashboardSubmitController implements ControllerInterface
{
    public function __construct(
        private DashboardService $dashboardService
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        $taskId = (int)$httpRequest->getPayload()['task_id'];

        $checked = $this->dashboardService->checkedTask($taskId);

        if ($checked) {
            return new RedirectResponse('/?checked_successfully');
        } else {
            return new RedirectResponse('/?checked_failed');
        }
    }
}