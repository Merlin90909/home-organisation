<?php

namespace Framework\Interfaces;

interface ValidatorInterface
{
    public function validate($input): bool;

    public function getMessages(): array;
}