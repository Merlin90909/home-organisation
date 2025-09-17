<?php

namespace App\Controller;

use App\Services\ArchiveService;
use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\ResponseInterface;
use Framework\Responses\HtmlResponse;
use Framework\Services\HtmlRenderer;

class ArchiveController implements ControllerInterface
{
    public function __construct(private HtmlRenderer $htmlRenderer,
    private ArchiveService $archiveService,)
    {
    }

    function handle($post, $get, $server, &$session): ResponseInterface
    {
        $items = $this->archiveService->getTaskItems();


        return new HtmlResponse($this->htmlRenderer->render('allTasks.phtml', [
            'items' => $items,
            'allTasksService' => $this->archiveService,
            'post' => $post
        ]));
    }
}