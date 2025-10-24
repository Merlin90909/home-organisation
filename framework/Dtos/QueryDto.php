<?php

namespace Framework\Dtos;

class QueryDto
{
    public function __construct(public string $query, public array $parameters)
    {
    }


}