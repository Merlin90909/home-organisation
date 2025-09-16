<?php

namespace App\Controller;

use App\Services\AccountService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Responses\RedirectResponse;

class AccountSubmitController implements ControllerInterface
{
    public function __construct(private AccountService $accountService)
    {
    }

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        $userId = $session['user_id'] ?? null;
        $email = $post['email'] ?? null;
        $email = strtolower($email);

        $updated = $this->accountService->setEmail($email, (int)$userId);

        if($updated) {
            $session['flash_success'] = 'E-Mail erfolgreich aktualisiert';
        }else{
            $session['flash_error'] = 'E-Mail ist nicht aktualisiert';
        }

        return new RedirectResponse('/account');
    }
}