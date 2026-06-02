<?php

namespace JsonApi\Query\Models;

class QueryParametersModel
{
    private ?PaginationFieldsModel $paginationFields = null;

    /** @var SortFieldModel[] */
    private array $sortFields = [];

    private array $filterFields = [];

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

    public function addFilterField(string $filterKey, string $filterValue): void
    {
        $filterKeys = [];
        $keys = array_filter(explode('.', $filterKey), static fn (string $key): bool => $key !== '');
        $current = &$filterKeys;

        foreach ($keys as $index => $key) {
            if ($index === array_key_last($keys)) {
                $current[$key] = $filterValue;
                continue;
            }

            $current[$key] = [];
            $current = &$current[$key];
        }

        $this->filterFields = array_merge($this->filterFields, $filterKeys);
    }

    public function getFilterFields(): array
    {
        return $this->filterFields;
    }
}
