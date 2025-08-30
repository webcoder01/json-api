<?php

namespace JsonApi\Query\Models;

class QueryParametersModel
{
    /** @var SortFieldModel[] */
    private array $sortFields = [];

    public function addSortField(string $field, bool $isAscending): void
    {
        $this->sortFields[] = new SortFieldModel($field, $isAscending);
    }

    public function getSortFields(): array
    {
        return $this->sortFields;
    }
}
