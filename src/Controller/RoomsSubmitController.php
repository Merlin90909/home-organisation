<?php

namespace App\Controller;

use App\Services\RoomsCreateService;
use App\Services\RoomsService;
use App\Validators\RoomsSubmitValidator;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\HtmlResponse;
use Framework\Responses\RedirectResponse;
use Framework\Services\HtmlRenderer;
use Framework\Validators\PayloadValidator;

class RoomsSubmitController implements ControllerInterface
{
    public function __construct(
        private RoomsCreateService $roomsCreateService,
        private HtmlRenderer $htmlRenderer,
        private RoomsService $roomsService,
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
            return new HtmlResponse($this->htmlRenderer->render('rooms.phtml', [
                'rooms' => $this->roomsService->getRooms($httpRequest->getSession()['user_id']),
                'error' => 'creation_failed'
            ]));
        }

        return new HtmlResponse($this->htmlRenderer->render('rooms.phtml', [
            'rooms' => $this->roomsService->getRooms($httpRequest->getSession()['user_id']),
            'error' => 'creation_success'
        ]));
    }
}