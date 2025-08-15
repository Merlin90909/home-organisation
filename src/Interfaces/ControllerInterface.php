<?php

interface ControllerInterface
{
    function handle($post, $get, $server, &$session): string;

}