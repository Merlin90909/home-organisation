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
        $roomName = $this->warehouseService->getRoomNames($session['created_for'] ?? 0) ?? '';

        $warehouse = $this->warehouseService->edit(
            $session['user_id'],
            $post['room_id'],
            $post['name'],
            $post['room_name'],
            $post['category'],
            $post['amount'],
        );
        if (!$warehouse) {
            return new RedirectResponse('Location: /warehouse?message=creation_failed');
        }

        return new RedirectResponse('Location: /warehouse?message=creation_success');
    }
}