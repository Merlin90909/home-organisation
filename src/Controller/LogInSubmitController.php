<?php

namespace App\Controller;

use App\Services\LoginService;
use App\Validators\EmailValidator;
use Framework\Interfaces\ValidatorInterface;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\RedirectResponse;

class LogInSubmitController implements ControllerInterface
{
    public function __construct(
        private LoginService $loginService,
        private ValidatorInterface $emptyValidator,
        private EmailValidator $emailValidator,
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        if ($this->emptyValidator->validate($httpRequest->getPayload()['email'])
            && $this->emailValidator->validate($httpRequest->getPayload()['email'])) {
            dd(1);
        } else {
            dd(0);

            $isLoggedin = $this->loginService->login(
                $httpRequest->getPayload()['email'],
                $httpRequest->getPayload()['password']
            );

            if (!$isLoggedin) {
                return new RedirectResponse('/login?error=login_failed');
            }
            return new RedirectResponse('/');
        }
    }
}