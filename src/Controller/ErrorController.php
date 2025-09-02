<?php
namespace App\Controller;

class ErrorController implements ControllerInterface
{
    public function __construct(private HtmlRenderer $htmlRenderer)
    {
    }
    function handle( $post,  $get,  $server,  &$session): string
    {
        return $this->htmlRenderer->render('error.phtml', $_POST);

    }
}