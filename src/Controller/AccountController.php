<?php

namespace App\Controller;

use App\Services\AccountService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Responses\HtmlResponse;
use Framework\Services\HtmlRenderer;

class AccountController implements ControllerInterface
{
    public function __construct(
        private HtmlRenderer $htmlRenderer,
        private AccountService $accountService
    ) {
    }

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        $user = $this->accountService->showParameters($session['user_id']);

        return new HtmlResponse($this->htmlRenderer->render('account.phtml', [
            'user' => $user,
        ]));
    }
}