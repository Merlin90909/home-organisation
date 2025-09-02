<?php
namespace App\Controller;

class LoginController implements ControllerInterface
{
    public function __construct(private HtmlRenderer $htmlRenderer)
    {
    }

    function handle($post, $get, $server, &$session): string
    {
        return $this->htmlRenderer->render('login.phtml', $_POST);
    }
}