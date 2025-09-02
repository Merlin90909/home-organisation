<?php

namespace App\Controller;

class WarehouseSubmitController implements ControllerInterface
{
    public function __construct(private WarehouseService $warehouseService)
    {
    }
    function handle($post, $get, $server, &$session): string
    {
        $warehouse = $this->warehouseService->edit(
            $post['name'],
            $post['category'],
            $post['amount']
        );
        if (!$warehouse) {
            header('Location: /warehouse?message=creation_failed');
        }

        header('Location: /warehouse?message=creation_success');
        return '';
    }
}