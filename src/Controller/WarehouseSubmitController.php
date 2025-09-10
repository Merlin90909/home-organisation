<?php

namespace App\Controller;

use App\Services\WarehouseService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Responses\RedirectResponse;

class WarehouseSubmitController implements ControllerInterface
{
    public function __construct(private WarehouseService $warehouseService)
    {
    }

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        $userId = (int)($session["user_id"] ?? 0);
        $roomId = (int)($post["room_id"] ?? 0);
        $name = (string)($post["name"] ?? "");
        $category = (string)($post["category"] ?? "");
        $amount = (int)($post["amount"] ?? 0);

        $warehouse = $this->warehouseService->edit($userId, $roomId, $name, $category, $amount);

        if (!$warehouse) {
            return new RedirectResponse('Location: /warehouse?message=creation_failed');
        }

        return new RedirectResponse('Location: /warehouse?message=creation_success');
    }
}