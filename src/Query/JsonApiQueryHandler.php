<?php

namespace JsonApi\Query;

use JsonApi\Query\Models\QueryParametersModel;

final class JsonApiQueryHandler implements JsonApiQueryHandlerInterface
{
    public function getQueryParsedFromUrl(string $url): QueryParametersModel
    {
        $queryParsed = (new UrlQueryParser())->parse($url);
        $model = new QueryParametersModel();
        if ($queryParsed->sort) {
            $this->setSortFieldsIntoModel($queryParsed->sort, $model);
        }

        return $model;
    }

    private function setSortFieldsIntoModel(string $sort, QueryParametersModel $model): void
    {
        $fields = explode(',', $sort);
        foreach ($fields as $field) {
            if (str_starts_with($field, '-')) {
                $model->addSortField(substr($field, 1), false);
                continue;
            }

            $model->addSortField($field, true);
        }
    }
}
