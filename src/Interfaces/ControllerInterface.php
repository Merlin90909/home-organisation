<?php

namespace App\Interfaces;

interface ControllerInterface
{
    function handle($post, $get, $server, &$session): ResponseInterface;

}