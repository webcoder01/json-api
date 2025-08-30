<?php

namespace JsonApi\Query\Models;

class SortFieldModel
{
    public function __construct(
        public readonly string $field,
        public readonly bool $isAscending
    ) {
    }
}
