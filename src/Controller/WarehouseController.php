<?php

namespace App\Controller;

class WarehouseController implements ControllerInterface
{
    public function __construct(
        private WarehouseService $warehouseService,
        private HtmlRenderer $htmlRenderer
    ) {
    }

    function handle($post, $get, $server, &$session): string
    {
        return $this->htmlRenderer->render('warehouse.phtml', [
            'error' => $get['message'] ?? null,
            'items' => $this->warehouseService->getItems(),
        ]);
    }
}