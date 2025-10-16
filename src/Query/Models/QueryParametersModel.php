<?php

namespace JsonApi\Query\Models;

class QueryParametersModel
{
    private ?PaginationFieldsModel $paginationFields = null;

    /** @var SortFieldModel[] */
    private array $sortFields = [];

    public function initPaginationFields(?int $offset, ?int $limit): void
    {
        $this->paginationFields = new PaginationFieldsModel($offset, $limit);
    }

    public function getPaginationFields(): ?PaginationFieldsModel
    {
        return $this->paginationFields;
    }

    public function addSortField(string $field, bool $isAscending): void
    {
        $this->sortFields[] = new SortFieldModel($field, $isAscending);
    }

    public function getSortFields(): array
    {
        return $this->sortFields;
    }
}
