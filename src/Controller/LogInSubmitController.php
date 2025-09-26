<?php

namespace App\Controller;

use App\Services\LoginService;
use App\Validators\LogInSubmitValidator;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\HtmlResponse;
use Framework\Responses\RedirectResponse;
use Framework\Services\HtmlRenderer;

class LogInSubmitController implements ControllerInterface
{

    public function __construct(
        private LoginService $loginService,
        private LogInSubmitValidator $payloadValidator,
        private HtmlRenderer $htmlRenderer,
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        $valid = $this->payloadValidator->validate($httpRequest->getPayload());

        if (!$valid) {
            $errors = $this->payloadValidator->getMessages();
            $html = $this->htmlRenderer->render('login.phtml', [
                'errors' => $errors
            ]);

            return new HtmlResponse($html);
        }
        $isLoggedin = $this->loginService->login(
            $httpRequest->getPayload()['email'],
            $httpRequest->getPayload()['password']
        );


        if ($isLoggedin) {
            return new RedirectResponse('/');
        }
        return new RedirectResponse('/login');
    }
}