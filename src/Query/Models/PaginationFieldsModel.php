<?php

namespace JsonApi\Query\Models;

class PaginationFieldsModel
{
    public function __construct(
        public readonly int $offset,
        public readonly int $limit
    ) {}
}