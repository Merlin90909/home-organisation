<?php

namespace App\Controller;

use App\Services\RoomsCreateService;
use App\Validators\RoomsSubmitValidator;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\RedirectResponse;

class RoomsSubmitController implements ControllerInterface
{
    public function __construct(
        private RoomsCreateService $roomsCreateService,
        private RoomsSubmitValidator $payloadValidator,
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        $valid = $this->payloadValidator->validate($httpRequest->getPayload());
        if (!$valid) {
            $allErrors = $this->payloadValidator->getMessages();

            foreach ($allErrors as $field => $messages) {
                foreach ($messages as $message) {
                    $_SESSION['flashMessages'][$field][] = $message;
                }
            }

            return new RedirectResponse("/rooms");
        }

        $create = $this->roomsCreateService->create(
            $httpRequest->getSession()['user_id'],
            $httpRequest->getPayload()['room_name'],
            $httpRequest->getPayload()['room_description']
        );
        if (!$create) {
            return new RedirectResponse("/rooms");
        }

        return new RedirectResponse("/rooms");
    }
}