<?php

namespace App\Controller;

use App\Entities\UserEntity;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Requests\httpRequests;
use Framework\Responses\HtmlResponse;
use Framework\Services\OrmService;

class AccountController implements ControllerInterface
{

    public function __construct(
        //private HtmlRenderer $htmlRenderer,
        //private AccountService $accountService,
        private OrmService $ormService
    ) {
    }

    function handle(httpRequests $httpRequest): ResponseInterface
    {
        //$user = $this->accountService->showParameters($httpRequest->getSession()['user_id']);

        //User finden funktioniert
        $user = $this->ormService->findById(2, UserEntity::class);

        //User löschen funktioniert
        //$this->ormService->delete($user);

        //User updaten
        //dd($this->ormService->save($user));
        //dd($this->ormService->update($user));


        dd($user);
        //$user->firstName = 'Jens';
        //$user->save($user);
        //$user2 = $this->ormService->save($user);

        return new HtmlResponse($this->htmlRenderer->render('account.phtml', [
            'user' => $user,
        ]));
    }
}