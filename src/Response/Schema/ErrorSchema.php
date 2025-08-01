<?php

namespace JsonApi\Response\Schema;

class ErrorSchema
{
    public function __construct(
        public readonly int $status,
        public readonly string $code,
        public readonly ?string $title = null,
        public readonly ?string $detail = null
    ) {}
}