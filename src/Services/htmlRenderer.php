<?php
class htmlRenderer{
    function render(string $view, array $data = []): string
    {
        ob_start();
        extract($data);
        unset ($data);
        require(__DIR__ . '/../../view/' . $view);
        $html = ob_get_clean();
        return $html;
    }
}
