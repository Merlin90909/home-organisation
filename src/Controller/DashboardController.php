<?php

namespace App\Controller;

class DashboardController implements ControllerInterface
{

    public function __construct(
        private HtmlRenderer $htmlRenderer,
        private DashboardService $dashboardService
    )
    {
    }

    function handle($post, $get, $server, &$session): string
    {
        if (!$_SESSION['logged_in']) {
            header('Location: /login');
        }

        $data = [
            'post' => $_POST,
            'dashboardService' => $this->dashboardService
        ];

        return $this->htmlRenderer->render('home.phtml', $data);
    }

}