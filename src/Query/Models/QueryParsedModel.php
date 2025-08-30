<?php

namespace JsonApi\Query\Models;

class QueryParsedModel
{
    public function __construct(
        public readonly ?string $sort,
    ) {
    }
}
