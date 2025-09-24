<?php

namespace App\Factories;

use App\Controller\LogInSubmitController;
use App\Services\LoginService;
use App\Validators\EmptyValidator;
use App\Validators\EmailValidator;
use Framework\Interfaces\FactoryInterface;
use Framework\Services\ObjectManagerService;

class LogInSubmitControllerFactory implements FactoryInterface
{
    public function __construct(
        private ObjectManagerService $objectManagerService
    ) {
    }

    public function produce(string $className): object
    {
        return new LogInSubmitController(
            $this->objectManagerService->get(LoginService::class),
            $this->objectManagerService->get(EmptyValidator::class),
            $this->objectManagerService->get(EmailValidator::class),
        );
    }
}