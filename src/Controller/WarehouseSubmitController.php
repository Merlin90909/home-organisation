<?php

class WarehouseSubmitController implements ControllerInterface
{
    function handle($post, $get, $server, &$session): string
    {
        $service = new WarehouseService();
        $warehouse = $service->edit(
            $post['name'],
            $post['category'],
            $post['amount']
        );

        $items = $service->getItems();

        $htmlRenderer = new htmlRenderer();
        if (!$warehouse) {
            return $htmlRenderer->render('warehouse.phtml', [
                'error' => 'creation_failed',
                'items' => $items,
            ]);
        }

        return $htmlRenderer->render('warehouse.phtml', [
            'success' => 'creation_success',
            'items' => $items,
        ]);
    }
}